<?php
namespace App\Database;

final class Connection
{
    private function __construct() { }

    public static function open()
    {
        $user  = 'root';
        $pass  = 'root';
        $name  = 'eventos';
        $host  = 'localhost';
        $type  = 'mysql';
        $port  = '3306';

        switch ( $type ) {

            case "pgsql":
                $port = $port ? $port : "5432";
                $conn = new \PDO( "pgsql:dbname={$name};user={$user};password={$pass};host=$host;port={$port}" );
                break;

            case "mysql":
                $port = $port ? $port : "3306";
                $conn = new \PDO( "mysql:host={$host};port={$port};dbname={$name}", $user, $pass, [ \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ] );
                break;

            default:
                throw new \Exception( "Driver não encontrado: " . $type );
                break;
        }

        $conn->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        return $conn;
    }
}
