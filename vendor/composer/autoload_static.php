<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit57c4d0eece65ef934da19a1d12c1a932
{
    public static $files = array (
        '2610a18e262a9328d59872ebc8f6b5db' => __DIR__ . '/..' . '/fpdo/fluentpdo/FluentPDO/FluentPDO.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 
            array (
                0 => __DIR__ . '/..' . '/psr/log',
            ),
        ),
    );

    public static $classMap = array (
        'upload' => __DIR__ . '/..' . '/verot/class.upload.php/src/class.upload.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit57c4d0eece65ef934da19a1d12c1a932::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit57c4d0eece65ef934da19a1d12c1a932::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit57c4d0eece65ef934da19a1d12c1a932::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit57c4d0eece65ef934da19a1d12c1a932::$classMap;

        }, null, ClassLoader::class);
    }
}
