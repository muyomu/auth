<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcff120934cd0ef38d9d493b3ace88d61
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'muyomu\\router\\' => 14,
            'muyomu\\database\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'muyomu\\router\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'muyomu\\database\\' => 
        array (
            0 => __DIR__ . '/..' . '/muyomu/database/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcff120934cd0ef38d9d493b3ace88d61::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcff120934cd0ef38d9d493b3ace88d61::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcff120934cd0ef38d9d493b3ace88d61::$classMap;

        }, null, ClassLoader::class);
    }
}
