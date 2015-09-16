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
        $json = json_decode(file_get_contents(ROOT . '/cron/timestamp.json'));

        foreach (self::$_tasks as $task => $time)
        {
            if (time() > $json->$task + $time) {
                forward_static_call([__CLASS__, $task]);
                $json->$task = time();
                file_put_contents(ROOT . '/cron/timestamp.json', json_encode($json));
            }
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