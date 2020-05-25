<?php
namespace AnalyticsSnippet\Tracker;

use Zend\EventManager\Event;

class InlineScript extends AbstractTracker
{
    public function track($url, $type, Event $event)
    {
        if ($type === 'html') {
            $this->trackInlineScript($url, $type, $event);
        }
    }
}
