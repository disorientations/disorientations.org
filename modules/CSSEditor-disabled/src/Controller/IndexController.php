<?php
namespace CSSEditor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use CSSEditor\Service\CssCleaner;

/**
 * The plugin controller for css editor.
 *
 * @package CSSEditor
 */
class IndexController extends AbstractActionController
{
    protected $cssCleaner;

    public function __construct(CssCleaner $cssCleaner)
    {
        $this->cssCleaner = $cssCleaner;
    }

    public function browseAction()
    {
        $response = $this->getResponse();
        $response->setContent('');

        if ($this->getRequest()->isPost()) {
            $css = $this->params()->fromPost('css');
            $siteId = $this->params()->fromPost('site');

            $css = $this->cssCleaner->clean($css);
            if ($siteId) {
                $siteSettings = $this->getSiteSettings($siteId);
                $siteSettings->set('css_editor_css', $css);
            } else {
                $this->settings()->set('css_editor_css', $css);
            }
        }

        $site_id = $this->params('id', '');
        if ($site_id) {
            $settings = $this->getSiteSettings($site_id);
        } else {
            $settings = $this->settings();
        }

        if ($settings) {
            $response->setContent($settings->get('css_editor_css'));
        }

        return $response;
    }

    protected function getSiteSettings($siteId)
    {
        $site = $this->api()->read('sites', $siteId)->getContent();
        $siteSettings = $this->siteSettings();
        $siteSettings->setTargetId($siteId);

        return $siteSettings;
    }
}
