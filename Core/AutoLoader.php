<?php

namespace Rave\Core;

class AutoLoader
{

    private static function autoload(string $className)
    {
        if (strpos($className, 'Rave') === 0) {
            require_once ROOT . '/' . str_replace('\\', '/', str_replace('Rave', null, $className)) . '.php';
        }
    }

    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

}
