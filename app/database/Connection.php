<?php
namespace App\Database;

use Config\Configurations;

final class Connection
{
    private function __clone() {}

    private function __wakeup() {}

    private function __construct() {}

    public static function open()
    {
        $dbconfig = Configurations::getDBConfig();

        switch ( $dbconfig['type'] ) {

            case 'pgsql':
                $dbconfig['port'] = $dbconfig['port'] ? $dbconfig['port'] : '5432';
                $conn = new \PDO(
                    "pgsql:dbname={$dbconfig['name']};".
                    "user={$dbconfig['user']};".
                    "password={$dbconfig['pass']};".
                    "host={$dbconfig['host']};".
                    "port={$dbconfig['port']}"
                );
                break;

            case 'mysql':
                $dbconfig['port'] = $dbconfig['port'] ? $dbconfig['port'] : '3306';
                $conn = new \PDO(
                    "mysql:host={$dbconfig['host']};".
                    "port={$dbconfig['port']};".
                    "dbname={$dbconfig['name']}",
                    $dbconfig['user'],
                    $dbconfig['pass'],
                    [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
                );
                break;

            default:
                throw new \Exception("Driver não encontrado: ".$dbconfig['type']);
                break;
        }

        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
