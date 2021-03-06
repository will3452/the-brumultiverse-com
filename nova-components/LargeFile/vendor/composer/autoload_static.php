<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfcf59cf427cd8ccc4d7e23fb55575c13
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Elezerk\\LargeFile\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Elezerk\\LargeFile\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfcf59cf427cd8ccc4d7e23fb55575c13::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfcf59cf427cd8ccc4d7e23fb55575c13::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfcf59cf427cd8ccc4d7e23fb55575c13::$classMap;

        }, null, ClassLoader::class);
    }
}
