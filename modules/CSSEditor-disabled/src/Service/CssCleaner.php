<?php

namespace CSSEditor\Service;

use HTMLPurifier_Config;
use HTMLPurifier;

class CssCleaner
{
    protected $htmlPurifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Filter.ExtractStyleBlocks', true);
        $config->set('CSS.AllowImportant', true);
        $config->set('CSS.AllowTricky', true);
        $config->set('CSS.Proprietary', true);
        $config->set('CSS.Trusted', true);

        $this->htmlPurifier = new HTMLPurifier($config);
    }

    public function clean($css)
    {
        $this->htmlPurifier->purify("<style>$css</style>");

        $clean_css = $this->htmlPurifier->context->get('StyleBlocks');
        return $clean_css[0];
    }
}
