<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf31a9603e60d1d703c6e453cb35c64be
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/app',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitf31a9603e60d1d703c6e453cb35c64be::$fallbackDirsPsr4;

        }, null, ClassLoader::class);
    }
}
