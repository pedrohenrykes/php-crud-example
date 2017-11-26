<?php

require_once "database/Connection.php";

class ProgramacoesControl
{
    public static function insert( $dados )
    {
        try {

            $conn = Connection::open();

            $stmt = $conn->prepare('
            INSERT INTO programacoes (nome, evento_id, descricao, data_evento, hora_inicio, hora_fim)
            VALUES (:nome, :evento_id, :descricao, :data_evento, :hora_inicio, :hora_fim)
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
            SELECT * FROM programacoes
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
            SELECT * FROM programacoes WHERE id = {$id}
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
            DELETE FROM programacoes WHERE id = :id
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
            UPDATE programacoes
            SET nome = :nome, evento_id = :evento_id, descricao = :descricao,
            data_evento = :data_evento, hora_inicio = :hora_inicio, hora_fim = :hora_fim
            WHERE id = :id
            ');

            $stmt->execute( $dados );

        } catch ( Exception $e ) {

            echo "ERROR" . $e->getMessage();

        }
    }
}
