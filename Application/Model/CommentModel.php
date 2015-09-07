<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class CommentModel extends Model
{

    protected static $table = 'rave_comment';

    protected static $primary = 'comment_id';

    public static function selectById($id, $limit)
    {
        return self::_getInstance()->query('SELECT comment_id, comment_author, comment_message, DATE_FORMAT(comment_publication, \'%d/%m/%Y %k:%i\') AS comment_date FROM ' . self::$table . ' WHERE photo_id = :photo_id ORDER BY comment_publication DESC LIMIT ' . $limit, [':photo_id' => $id]);
    }

}