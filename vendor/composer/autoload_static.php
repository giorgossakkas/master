<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit744c2172a285006dea3acb92c7ce4e15
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit744c2172a285006dea3acb92c7ce4e15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit744c2172a285006dea3acb92c7ce4e15::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
