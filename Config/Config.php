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
        'password' => 'root',
        //'port'     => ''
    ];

    private static $_error = [
        '500' => '/internal-server-error',
        '404' => '/not-found',
        '403' => '/forbidden'
    ];

    private static $_session = [
        'admin' => '4e8z3f7vdff8ze65azd25ef46e4f986z',
        'user'  => 'f4e6h2v5z9f56se4fs67er4ht4h+drgr'
    ];

    private static $_encryption = [
    	'mode'   => MCRYPT_MODE_CBC,
    	'cypher' => MCRYPT_RIJNDAEL_256,
    	'key'    => 'c70911343b8a3b94f5780ce5e65d2daa',
    	'iv'     => 'dc4931bc7b44eebb62e4e5e590a54461401b8ea9d9b39546d7aab4b44cdfe3c6'
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
