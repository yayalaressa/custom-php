<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf3c4ab80fb0e9d98d131bdbf9861c37a
{
    public static $files = array (
        '3dbe503f0b73e4bc086225a95162d760' => __DIR__ . '/../../..' . '/system/includes/session.php',
        '8506a6de1171797e81bf4197f002cef5' => __DIR__ . '/../../..' . '/system/includes/functions.php',
        'e3a69a5c28f638fc7e92714268928b9a' => __DIR__ . '/../../..' . '/system/includes/security.php',
        '2c810469758b8615e9b4755a80f5ed6c' => __DIR__ . '/../../..' . '/system/core/minifier.php',
        '3b8b31fa4e952ccaf2fee18915a824a9' => __DIR__ . '/../../..' . '/system/core/app.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Snipworks\\Smtp\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Snipworks\\Smtp\\' => 
        array (
            0 => __DIR__ . '/..' . '/snipworks/php-smtp/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Bramus\\Router\\Router' => __DIR__ . '/..' . '/bramus/router/src/Bramus/Router/Router.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Snipworks\\Smtp\\Email' => __DIR__ . '/..' . '/snipworks/php-smtp/src/Email.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf3c4ab80fb0e9d98d131bdbf9861c37a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf3c4ab80fb0e9d98d131bdbf9861c37a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf3c4ab80fb0e9d98d131bdbf9861c37a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf3c4ab80fb0e9d98d131bdbf9861c37a::$classMap;

        }, null, ClassLoader::class);
    }
}
