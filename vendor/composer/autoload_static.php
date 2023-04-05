<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf3d1b9f3fe48200d9dac0b5d43fa3ab6
{
    public static $files = array (
        '8c102e85af26544dfc307cd691c43900' => __DIR__ . '/../..' . '/app/Helpers/Asset.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WilliamCosta\\DotEnv\\' => 20,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'B' => 
        array (
            'BalintHorvath\\DotEnv\\' => 21,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WilliamCosta\\DotEnv\\' => 
        array (
            0 => __DIR__ . '/..' . '/william-costa/dot-env/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'BalintHorvath\\DotEnv\\' => 
        array (
            0 => __DIR__ . '/..' . '/balint-horvath/dotenv-php/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf3d1b9f3fe48200d9dac0b5d43fa3ab6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf3d1b9f3fe48200d9dac0b5d43fa3ab6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf3d1b9f3fe48200d9dac0b5d43fa3ab6::$classMap;

        }, null, ClassLoader::class);
    }
}
