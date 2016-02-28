<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class LikeModel extends Model
{

    protected static $table = 'rave_like';

    protected static $primary = 'like_ip';

    public static function liked($ip, $id)
    {
        return self::queryOne('SELECT COUNT(' . self::$primary . ') AS ip_count FROM ' . self::$table . ' WHERE photo_id = :photo_id AND ' . self::$primary . ' = :like_ip', [':photo_id' => $id, ':like_ip' => $ip])->ip_count > 0;
    }

    public static function deleteAll()
    {
        self::execute('DELETE FROM ' . self::$table);
    }

}