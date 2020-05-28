<?php

$dev = getenv('APP_ENV') === 'local';

return [
    'logger' => [
        'log' => false,
        'priority' => \Zend\Log\Logger::NOTICE,
    ],
    'http_client' => [
        'sslcapath' => null,
        'sslcafile' => null,
    ],
    'cli' => [
        'phpcli_path' => '/usr/local/bin/php',
    ],
    'thumbnails' => [
        'types' => [
            'large' => ['constraint' => 800],
            'medium' => ['constraint' => 200],
            'square' => ['constraint' => 200],
        ],
        'thumbnailer_options' => [
            'imagemagick_dir' => '/usr/bin/',
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
    ],
    'service_manager' => [
        'aliases' => [
            'Omeka\File\Store' => 'Omeka\File\Store\Local',
            'Omeka\File\Thumbnailer' => 'Omeka\File\Thumbnailer\ImageMagick',
        ],
    ],
    'file_store' => [
        'local' => [
            'base_path' => null, // Or the full path on the server if needed.
            'base_uri' => $dev ? 'http://localhost:8080/files' : 'https://disorientations.org/files',
        ],
    ],
];
