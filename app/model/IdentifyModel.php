<?php

namespace rave\app\Model;

use rave\core\Model;

class IdentifyModel extends Model
{

    protected static $table = 'rave_identify';

    protected static $primary = 'tag_id, photo_id';

    public static function deleteTagWherePhotoId($id)
    {
        self::execute('DELETE FROM ' . self::$table . ' WHERE photo_id = :photo_id', [':photo_id' => $id]);
    }

}