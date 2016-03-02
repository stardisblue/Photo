<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class AdminModel extends Model
{

    protected static $table = 'rave_admin';

    protected static $primary = 'admin_login';

    public static function exists(string $login): bool
    {
        return self::queryOne('SELECT COUNT(' . self::$primary . ') AS counter FROM ' . self::$table . ' WHERE ' . self::$primary . ' = :login', [':login' => $login])->counter > 0;
    }

}
