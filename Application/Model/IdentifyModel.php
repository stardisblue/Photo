<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class IdentifyModel extends Model
{

    protected static $table = 'rave_identify';

    protected static $primary = 'tag_id, photo_id';

    public static function deleteTagWherePhotoId($id)
    {
        self::_getInstance()->execute('DELETE FROM ' . self::$table . ' WHERE photo_id = :photo_id', [':photo_id' => $id]);
    }

}