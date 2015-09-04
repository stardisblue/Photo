<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class CommentModel extends Model
{

    protected static $table = 'rave_comment';

    protected static $primary = 'comment_id';

    public static function selectById($id)
    {
        return self::_getInstance()->query('SELECT * FROM ' . self::$table . ' WHERE ' . self::$primary . ' = :id', [':id' => $id]);
    }

}