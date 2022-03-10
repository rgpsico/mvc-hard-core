<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ef83b7f848c20e6346a718f779b4542
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ef83b7f848c20e6346a718f779b4542::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ef83b7f848c20e6346a718f779b4542::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ef83b7f848c20e6346a718f779b4542::$classMap;

        }, null, ClassLoader::class);
    }
}