<?php

namespace Rave\Core\Database;

use Rave\Core\Database\Driver\GenericDriver;
use Rave\Core\Exception\UnknownDriverException;
use Rave\Core\Database\Driver\MySQLDriverPDO\MySQLDriverPDO;
use Rave\Core\Database\Driver\SQLiteDriverPDO\SQLiteDriverPDO;
use Rave\Core\Database\Driver\SQLiteDriverPDO\PostgreSQLDriverPDO;

class DriverFactory
{
    const MYSQL_PDO = 'MySQLPDO';
    const SQLITE_PDO = 'SQLitePDO';
    const POSTGRESQL_PDO = 'PostgreSQLPDO';

    public static function get(string $driverConstant): GenericDriver
    {
        switch ($driverConstant) {
            case self::MYSQL_PDO:
                return new MySQLDriverPDO();
            case self::SQLITE_PDO:
                return new SQLiteDriverPDO();
            case self::POSTGRESQL_PDO:
                return new PostgreSQLDriverPDO();
            default:
                throw new UnknownDriverException('Driver ' . $driverConstant . ' does not exists');
        }
    }
	
}
