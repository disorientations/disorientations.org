<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5f17072e717b1a960a7de77e337b2fe3
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BulkEdit\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BulkEdit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5f17072e717b1a960a7de77e337b2fe3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5f17072e717b1a960a7de77e337b2fe3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
