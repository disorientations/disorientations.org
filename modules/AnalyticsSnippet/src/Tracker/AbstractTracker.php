<?php
namespace AnalyticsSnippet\Tracker;

use Omeka\Stdlib\Message;
use Zend\EventManager\Event;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractTracker implements TrackerInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $services;

    public function setServiceLocator(ServiceLocatorInterface $services)
    {
        $this->services = $services;
    }

    /**
     * Get service locator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->services;
    }

    public function track($url, $type, Event $event)
    {
        if ($type === 'html') {
            $this->trackInlineScript($url, $type, $event);
        } else {
            $this->trackNotInlineScript($url, $type, $event);
        }
    }

    protected function trackInlineScript($url, $type, Event $event)
    {
        $routeMatch = $this->services->get('Application')->getMvcEvent()->getRouteMatch();
        // Manage public error.
        if (empty($routeMatch)) {
            $inlineScript = 'analyticssnippet_inline_public';
        } elseif ($routeMatch->getParam('__SITE__')) {
            $inlineScript = 'analyticssnippet_inline_public';
        } elseif ($routeMatch->getParam('__ADMIN__')) {
            $inlineScript = 'analyticssnippet_inline_admin';
        }
        // Manage bad routing of some modules.
        else {
            $basePath = $this->services->get('ViewHelperManager')->get('BasePath');
            $inlineScript = strpos($_SERVER['REQUEST_URI'], $basePath() . '/admin') === 0
                ? 'analyticssnippet_inline_admin'
                : 'analyticssnippet_inline_public';
        }

        $settings = $this->services->get('Omeka\Settings');
        $inlineScript = $settings->get($inlineScript);
        if (empty($inlineScript)) {
            return;
        }

        $response = $event->getResponse();
        $content = $response->getContent();
        $endTagBody = strripos((string) $content, '</body>', -7);
        if (empty($endTagBody)) {
            $this->trackError($url, $type, $event);
            return;
        }

        $content = substr_replace($content, $inlineScript, $endTagBody, 0);
        $response->setContent($content);
    }

    protected function trackNotInlineScript($url, $type, Event $event)
    {
    }

    protected function trackError($url, $type, Event $event)
    {
        $logger = $this->services->get('Omeka\Logger');
        $logger->err(new Message('Error in content "%s" from url %s (referrer: %s; user agent: %s; user #%d; ip %s).', // @translate
            $type, $url, $this->getUrlReferrer(), $this->getUserAgent(), $this->getUserId(), $this->getClientIp()));
    }

    /**
     * Get the url referrer.
     *
     * @return string
     */
    protected function getUrlReferrer()
    {
        return @$_SERVER['HTTP_REFERER'];
    }

    /**
     * Get the ip of the client.
     *
     * @return string
     */
    protected function getClientIp()
    {
        $ip = (new RemoteAddress())->getIpAddress();
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
            || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
        ) {
            return $ip;
        }
        return '::';
    }

    /**
     * Get the user agent.
     *
     * @return string
     */
    protected function getUserAgent()
    {
        return @$_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Get the user id.
     *
     * @return int
     */
    protected function getUserId()
    {
        $services = $this->getServiceLocator();
        $identity = $services->get('ViewHelperManager')->get('Identity');
        $user = $identity();
        return $user ? $user->getId() : 0;
    }
}
