<?php

namespace Rave\Core\Database\Driver\MySQLDriverPDO;

use PDO, PDOException;

use Rave\Core\Error;
use Rave\Config\Config;
use Rave\Core\Database\Driver\GenericDriver;

class  implements GenericDriver
{
    private static $instance;

    private static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO('pgsql:dbname=' . Config::getDatabase('database') . ';host=' . Config::getDatabase('host'), Config::getDatabase('login'), Config::getDatabase('password'), [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $pdoException) {
                Error::create($pdoException->getMessage(), 500);
            }
        }

        return self::$instance;
    }
    
    private function queryDatabase(string $statement, array $values, bool $unique)
    {
    	try {
            $sql = self::getInstance()->prepare($statement);
            $sql->execute($values);

            if ($unique === true) {
                $result = $sql->fetch(PDO::FETCH_OBJ);
            	return $result === false ? null : $result;
            }
            $result = $sql->fetchAll(PDO::FETCH_OBJ);
            return $result === false ? null : $result;
    	} catch (PDOException $pdoException) {
            Error::create($pdoException->getMessage(), 500);
    	}
    }
    
    public function query(string $statement, array $values = []): array
    {
        return $this->queryDatabase($statement, $values, false);
    }
    
    public function queryOne(string $statement, array $values = [])
    {
        return $this->queryDatabase($statement, $values, true);
    }

    public function execute(string $statement, array $values = [])
    {
        try {
            $sql = $this->getInstance()->prepare($statement);
            $sql->execute($values);
        } catch (PDOException $pdoException) {
            Error::create($pdoException->getMessage(), 500);
        }
    }

    public function lastInsertId(): string
    {
        return self::getInstance()->lastInsertId();
    }

}
