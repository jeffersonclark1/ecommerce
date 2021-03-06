<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit91b06605262875a0c604fcf03e5cf6a2
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit91b06605262875a0c604fcf03e5cf6a2::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit91b06605262875a0c604fcf03e5cf6a2::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
