<?php

namespace rave\app\Model;

use rave\core\Model;

class GalleryModel extends Model
{

    protected static $table = 'rave_gallery';

    protected static $primary = 'photo_id';

    public static function selectPhoto()
    {
        return self::query('SELECT * FROM rave_photo NATURAL JOIN ' . self::$table);
    }

}