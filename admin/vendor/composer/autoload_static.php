<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d9207101164fa5bc8dfac797e110f6c
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Giggsey\\Locale\\' => 15,
        ),
        'C' => 
        array (
            'CALLR\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Giggsey\\Locale\\' => 
        array (
            0 => __DIR__ . '/..' . '/giggsey/locale/src',
        ),
        'CALLR\\' => 
        array (
            0 => __DIR__ . '/..' . '/callr/sdk-php/src/CALLR',
        ),
    );

    public static $prefixesPsr0 = array (
        'l' => 
        array (
            'libphonenumber' => 
            array (
                0 => __DIR__ . '/..' . '/giggsey/libphonenumber-for-php/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d9207101164fa5bc8dfac797e110f6c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d9207101164fa5bc8dfac797e110f6c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6d9207101164fa5bc8dfac797e110f6c::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
