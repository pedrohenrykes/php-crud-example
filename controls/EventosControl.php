<?php

require_once "database/Connection.php";

class EventosControl
{
    public static function insert( $dados )
    {
        try {

            $conn = Connection::open();

            $stmt = $conn->prepare('
            INSERT INTO eventos (nome, local_id, edicao, descricao, data_inicio, data_fim)
            VALUES (:nome, :local_id, :edicao, :descricao, :data_inicio, :data_fim)
            ');

            $stmt->execute( $dados );

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

        }
    }

    public static function selectAll()
    {
        try {

            $conn = Connection::open();

            $dados = $conn->query('
            SELECT * FROM eventos
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

            $conn = Connection::open();

            $dados = $conn->query("
            SELECT * FROM eventos WHERE id = {$id}
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

            $conn = Connection::open();

            $stmt = $conn->prepare('
            DELETE FROM eventos WHERE id = :id
            ');

            $stmt->bindParam(':id', $id);

            $stmt->execute();

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

        }
    }

    public static function update( $dados )
    {
        try {

            $conn = Connection::open();

            $stmt = $conn->prepare('
            UPDATE eventos
            SET nome = :nome, local_id = :local_id, edicao = :edicao,
            descricao = :descricao, data_inicio = :data_inicio, data_fim = :data_fim
            WHERE id = :id
            ');

            $stmt->execute( $dados );

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

        }
    }
}
