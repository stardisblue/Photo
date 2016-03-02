<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class ContactModel extends Model
{

    protected static $table = 'rave_contact';

    protected static $primary = 'contact_ip';

    public static function deleteAll()
    {
        self::execute('DELETE FROM ' . self::$table);
    }

    public static function exists(string $hash): bool
    {
        return self::queryOne('SELECT COUNT(' . self::$primary . ') AS counter FROM ' . self::$table . ' WHERE ' . self::$primary . ' = :hash', [':hash' => $hash])->counter > 0;
    }

}