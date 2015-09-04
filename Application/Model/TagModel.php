<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class TagModel extends Model
{

    protected static $table = 'rave_tag';

    protected static $primary = 'tag_id';

    public static function selectTagId($name)
    {
        return self::_getInstance()->queryOne('SELECT ' . self::$primary . ' AS max_id FROM ' . self::$table . ' WHERE tag_name = :tag_name', [':tag_name' => $name])->max_id;
    }

    public static function selectPhotoTag($id)
    {
        return self::_getInstance()->query('SELECT tag_name FROM ' . self::$table . ' NATURAL JOIN rave_identify NATURAL JOIN rave_photo WHERE photo_id = :photo_id', [':photo_id' => $id]);
    }

    public static function existsTagName($name)
    {
        return self::_getInstance()->queryOne('SELECT Count(tag_id) AS tag_count FROM ' . self::$table . ' WHERE tag_name = :tag_name', [':tag_name' => $name])->tag_count > 0;
    }

}