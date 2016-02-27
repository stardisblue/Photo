<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class PhotoModel extends Model
{

    protected static $table = 'rave_photo';

    protected static $primary = 'photo_id';

    public static function selectAllByTag($tag_id)
    {
        return self::query('SELECT * FROM ' . self::$table . ' NATURAL JOIN rave_identify WHERE tag_id = :tag_id GROUP BY photo_id', [':tag_id' => $tag_id]);
    }

    public static function selectWithFormattedDate($id)
    {
        return self::queryOne('SELECT photo_id, photo_name, photo_title, photo_visit, photo_like, photo_description, DATE_FORMAT(photo_publication, \'%b\') AS photo_month, DATE_FORMAT(photo_publication, \'%d\') AS photo_day FROM ' . self::$table . ' WHERE photo_id = :photo_id', [':photo_id' => $id]);
    }

    public static function selectLikeQuery($query)
    {
        $tagName = '%' . $query . '%';
        $photoTitle = '%' . $query . '%';
        return self::query('SELECT * FROM ' . self::$table . ' NATURAL JOIN rave_identify NATURAL JOIN rave_tag WHERE tag_name LIKE :tag_name OR photo_title LIKE :photo_title GROUP BY photo_id', [':tag_name' => $tagName, ':photo_title' => $photoTitle]);
    }

}