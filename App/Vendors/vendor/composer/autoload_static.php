<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95cf41d17d37e81df335e163bc429bdf
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
        '37920fbd6eaeababa873d97ba1c5324c' => __DIR__ . '/..' . '/hellonico/timber-dump-extension/functions.php',
        '413614dbc06bade22a685c0ebe14027c' => __DIR__ . '/..' . '/wordplate/acf/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WordPlate\\Acf\\' => 14,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'H' => 
        array (
            'HelloNico\\Twig\\' => 15,
            'HelloNico\\Timber\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WordPlate\\Acf\\' => 
        array (
            0 => __DIR__ . '/..' . '/wordplate/acf/src',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'HelloNico\\Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/hellonico/twig-dump-extension/src',
        ),
        'HelloNico\\Timber\\' => 
        array (
            0 => __DIR__ . '/..' . '/hellonico/timber-dump-extension/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95cf41d17d37e81df335e163bc429bdf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95cf41d17d37e81df335e163bc429bdf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit95cf41d17d37e81df335e163bc429bdf::$classMap;

        }, null, ClassLoader::class);
    }
}
