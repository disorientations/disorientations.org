<?php
return [
    'controllers' => [
        'factories' => [
            'CSSEditor\Controller\Index' => 'CSSEditor\Service\Controller\IndexControllerFactory',
        ],
    ],
    'router' =>[
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'csseditor' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/csseditor/browse[/:id]',
                            'defaults' => [
                                '__NAMESPACE__' => 'CSSEditor\Controller',
                                'controller' => 'Index',
                                'action' => 'browse',
                            ],
                        ],
                    ]
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            'CSSEditor\CssCleaner' => 'CSSEditor\Service\CssCleanerFactory',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'siteSelect' => 'CSSEditor\View\Helper\SiteSelect',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ]
    ]
];
