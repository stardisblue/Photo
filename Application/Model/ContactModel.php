<?php

namespace Rave\Application\Model;

use Rave\Core\Model;

class ContactModel extends Model
{

    protected static $table = 'rave_contact';

    protected static $primary = 'contact_ip';

    public static function deleteAll()
    {
        self::_getInstance()->execute('DELETE FROM ' . self::$table);
    }

}