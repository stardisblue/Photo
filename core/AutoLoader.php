<?php

namespace rave\core;

class AutoLoader
{

    private static function autoload(string $className)
    {
        if (strpos($className, 'rave') === 0) {
            require_once ROOT . '/' . str_replace('\\', '/', str_replace('rave', null, $className)) . '.php';
        }
    }

    public static function register()
    {
        spl_autoload_register([self::class, 'autoload']);
    }

}
