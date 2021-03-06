<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc5a5f25a97b7620267ff389b07e74ed8
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SMSGatewayMe\\Client\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SMSGatewayMe\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/smsgatewayme/client/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc5a5f25a97b7620267ff389b07e74ed8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc5a5f25a97b7620267ff389b07e74ed8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc5a5f25a97b7620267ff389b07e74ed8::$classMap;

        }, null, ClassLoader::class);
    }
}
