<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0623bc1d0c9ba7743a39bd0cb3c6f4f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf0623bc1d0c9ba7743a39bd0cb3c6f4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf0623bc1d0c9ba7743a39bd0cb3c6f4f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}