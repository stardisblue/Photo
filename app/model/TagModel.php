<?php

namespace rave\app\Model;

use rave\core\Model;

class TagModel extends Model
{

    protected static $table = 'rave_tag';

    protected static $primary = 'tag_id';

    public static function selectTagId($name)
    {
        return self::queryOne('SELECT ' . self::$primary . ' AS max_id FROM ' . self::$table . ' WHERE tag_name = :tag_name', [':tag_name' => $name])->max_id;
    }

    public static function selectPhotoTag($id)
    {
        return self::query('SELECT tag_id, tag_name, tag_slug FROM ' . self::$table . ' NATURAL JOIN rave_identify NATURAL JOIN rave_photo WHERE photo_id = :photo_id', [':photo_id' => $id]);
    }

    public static function selectPopularTag($limit)
    {
        return self::query('SELECT tag_name, count(tag_id) AS count_id FROM rave_tag NATURAL JOIN rave_identify GROUP BY tag_name ORDER BY count_id DESC', [':limit' => $limit]);
    }

    public static function existsTagName($name) : bool
    {
        return self::queryOne('SELECT Count(' . self::$primary . ') AS tag_count FROM ' . self::$table . ' WHERE tag_name = :tag_name', [':tag_name' => $name])->tag_count > 0;
    }

    public static function deleteUnusedTags()
    {
        self::execute('DELETE FROM ' . self::$table . ' WHERE ' . self::$primary . ' NOT IN (SELECT tag_id FROM rave_identify GROUP BY tag_id)');
    }

}