<?php
namespace AnalyticsSnippet;

return [
    'form_elements' => [
        'invokables' => [
            Form\SettingsFieldset::class => Form\SettingsFieldset::class,
        ],
    ],
    'analyticssnippet' => [
        'settings' => [
            'analyticssnippet_inline_public' => '',
            'analyticssnippet_inline_admin' => '',
        ],
        'trackers' => [
            'default' => Tracker\InlineScript::class,
        ],
    ],
];
