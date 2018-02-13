<?php
namespace Config;

class Configurations
{
    private function __clone() {}

    private function __wakeup() {}

    private function __construct() {}

    public static function getPages()
    {
        return [
            'ListagemLocais' => 'Cadastro de Locais',
            'ListagemEventos' => 'Cadastro de Eventos',
            'ListagemProgramacoes' => 'Cadastro de Programações'
        ];
    }

    public static function getDBConfig()
    {
        return [
            'user' => 'root',
            'pass' => 'root',
            'name' => 'eventos',
            'host' => 'localhost',
            'type' => 'mysql',
            'port' => '3306'
        ];
    }
}
