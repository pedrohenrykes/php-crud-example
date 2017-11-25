<?php

require_once "database/Connection.php";

class LocaisControl
{
    public static function insert( $dados )
    {
        try {

            $conn = Connection::open();

            $stmt = $conn->prepare('
            INSERT INTO locais (nome, municipio, bairro, endereco)
            VALUES (:nome, :municipio, :bairro, :endereco)
            ');

            $stmt->execute( $dados );

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

            return NULL;

        }
    }

    public static function selectAll()
    {
        try {

            $conn = Connection::open( "database" );

            $dados = $conn->query('
            SELECT * FROM locais
            ');

            return $dados;

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

            return NULL;

        }
    }

    public static function selectOne( $id )
    {
        try {

            $conn = Connection::open( "database" );

            $dados = $conn->query("
            SELECT * FROM locais WHERE id = {$id}
            ");

            return $dados;

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

            return NULL;

        }
    }

    public static function delete( $id )
    {
        try {

            $conn = Connection::open( "database" );

            $stmt = $conn->prepare('
            DELETE FROM locais WHERE id = :id
            ');

            $stmt->bindParam(':id', $id);

            $stmt->execute();

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

            return NULL;

        }
    }

    public static function update( $dados )
    {
        try {

            $conn = Connection::open( "database" );

            $stmt = $conn->prepare('
            UPDATE locais
            SET nome = :nome, municipio = :municipio, bairro = :bairro, endereco = :endereco
            WHERE id = :id
            ');

            $stmt->execute( $dados );

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

            return NULL;

        }
    }
}
