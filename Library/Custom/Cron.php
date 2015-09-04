<?php

namespace Rave\Library\Custom;

use Rave\Application\Model\ContactModel;

class Cron
{
    private static $_tasks = [
        'cleanIp'
    ];

    public static function execute()
    {
        if (time() > (int) file_get_contents(ROOT . '/cron/timestamp') + 20 * 60) {
            foreach (self::$_tasks as $task) {
                forward_static_call([__CLASS__, $task]);
            }

            file_put_contents(ROOT . '/cron/timestamp', time());
        }
    }

    private static function cleanIp()
    {
        ContactModel::deleteAll();
    }

}