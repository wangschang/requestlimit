<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a35e23c7e4bbbe973bf7ed8df1c49bf
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RequestLimit\\' => 13,
        ),
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RequestLimit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a35e23c7e4bbbe973bf7ed8df1c49bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a35e23c7e4bbbe973bf7ed8df1c49bf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6a35e23c7e4bbbe973bf7ed8df1c49bf::$classMap;

        }, null, ClassLoader::class);
    }
}
