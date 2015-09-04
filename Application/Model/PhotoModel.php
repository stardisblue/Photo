<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class PhotoModel extends Model
{

    protected static $table = 'rave_photo';

    protected static $primary = 'photo_id';

    public static function selectLastId()
    {
        return self::_getInstance()->queryOne('SELECT Max(' . self::$primary . ') as max_id FROM ' . self::$table)->max_id;
    }

    public static function selectForGallery($limit)
    {

    }

}