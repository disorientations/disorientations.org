<?php
namespace Next\Site\BlockLayout;

use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Zend\View\Renderer\PhpRenderer;

/**
 * @deprecated Use the same feature in module BlockPlus.
 */
class SearchForm extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Search simple form'; // @translate
    }

    public function form(
        PhpRenderer $view,
        SiteRepresentation $site,
        SitePageRepresentation $page = null,
        SitePageBlockRepresentation $block = null
    ) {
        // Factory is not used to make rendering simpler.
        $services = $site->getServiceLocator();
        $formElementManager = $services->get('FormElementManager');
        $defaultSettings = $services->get('Config')['next']['block_settings']['searchForm'];
        $blockFieldset = \Next\Form\SearchFormFieldset::class;

        $data = $block ? $block->data() + $defaultSettings : $defaultSettings;

        $dataForm = [];
        foreach ($data as $key => $value) {
            $dataForm['o:block[__blockIndex__][o:data][' . $key . ']'] = $value;
        }

        $fieldset = $formElementManager->get($blockFieldset);
        $fieldset->populateValues($dataForm);

        $html = $view->formCollection($fieldset);
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $data = $block->data();
        return $view->partial('common/block-layout/search-form', $data);
    }
}
