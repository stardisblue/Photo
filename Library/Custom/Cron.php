<?php

namespace Rave\Library\Custom;

use Rave\Application\Model\LikeModel;
use Rave\Application\Model\ContactModel;

class Cron
{
    private static $_tasks = [
        'flushLike' => 86400,
        'flushContact' => 1200
    ];

    public static function execute()
    {
        $iniFile = parse_ini_file(ROOT . '/cron/timestamp.ini');

        foreach (self::$_tasks as $task => $time)
        {
            if (time() > $iniFile[$task] + $time) {
                forward_static_call([__CLASS__, $task]);
                $iniFile[$task] = time();
                self::writeIniFile($iniFile, ROOT . '/cron/timestamp.ini');
            }
        }
    }

    private static function writeIniFile($array, $file)
    {
        $result = [];

        foreach($array as $key => $value)
        {
            $result[] = $key . '=' . $value;
        }

        if ($filePointer = fopen($file, 'w')) {
            fwrite($filePointer, implode("\r\n", $result));
            fclose($filePointer);
        }
    }

    private static function flushContact()
    {
        ContactModel::deleteAll();
    }

    private static function flushLike()
    {
        LikeModel::deleteAll();
    }

}