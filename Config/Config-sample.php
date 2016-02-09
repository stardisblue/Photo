<?php

namespace Rave\Config;

use Rave\Core\Error;
use Rave\Core\Database\DriverFactory;

class Config
{
    private static $_debug = true;

    private static $_database = [
        'driver'   => DriverFactory::MYSQL_PDO,
        'host'     => 'localhost',
        'database' => 'photo',
        'login'    => 'root',
        'password' => '',
        //'port'     => ''
    ];

    private static $_error = [
        '500' => '/internal-server-error',
        '404' => '/not-found',
        '403' => '/forbidden'
    ];

    // Session salt
    private static $_session = [
        'admin' => '',
        'user'  => ''
    ];

    // key encryption
    private static $_encryption = [
    	'mode'   => MCRYPT_MODE_CBC,
    	'cypher' => MCRYPT_RIJNDAEL_256,
    	'key'    => '',
    	'iv'     => ''
    ];

    public static function isDebug(): bool
    {
        return self::$_debug;
    }

    public static function getDatabase(string $key): string
    {
    	if (isset(self::$_database[$key])) {
            return self::$_database[$key];
    	} else {
            Error::create('Unknown database key : ' . $key, 500);
    	}
    }

    public static function getError(string $key): string
    {
    	if (isset(self::$_error[$key])) {
            return self::$_error[$key];
    	} else {
            Error::create('Unknown error key : ' . $key, 404);
    	}
    }

    public static function getSession(string $key): string
    {
        if (isset(self::$_session[$key])) {
            return self::$_session[$key];
        } else {
            Error::create('Unknown session key : ' . $key, 500);
        }
    }

    public static function getEncryption(string $key): string
    {
        if (isset(self::$_encryption[$key])) {
            return self::$_encryption[$key];
        } else {
            Error::create('Unknown encryption key : ' . $key, 500);
        }
    }

}
