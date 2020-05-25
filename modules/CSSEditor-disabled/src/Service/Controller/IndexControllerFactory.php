<?php

namespace CSSEditor\Service\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use CSSEditor\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $controller = new IndexController(
            $services->get('CSSEditor\CssCleaner')
        );

        return $controller;
    }
}
