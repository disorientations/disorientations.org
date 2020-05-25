<?php

namespace CSSEditor\View\Helper;

use Zend\Form\Element\Select;
use Zend\View\Helper\AbstractHelper;

/**
 * A select menu containing all sites.
 */
class SiteSelect extends AbstractHelper
{
    public function __invoke($name = null, $options = [])
    {
        $element = new Select($name, $options);
        $element->setValueOptions($this->getSiteOptions());
        return $this->getView()->formSelect($element);
    }

    public function getSiteOptions()
    {
        $sites = $this->getView()->api()->search('sites')->getContent();
        $options = [];
        foreach ($sites as $site) {
            $options[$site->id()] = $site->title();
        }

        return $options;
    }
}
