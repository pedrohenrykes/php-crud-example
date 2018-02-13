<?php

use App\Controllers\EventosControl;
use App\Controllers\LocaisControl;

$editar = [];

if ( isset( $_GET[ "acao" ] ) ) {

    switch( $_GET[ "acao" ] ) {

        case "salvar":

            $data_inicio = new DateTime( $_POST[ "data_inicio" ] );
            $data_fim    = new DateTime( $_POST[ "data_fim" ] );

            $dados = [
                ":nome"        => $_POST[ "nome" ],
                ":local_id"    => $_POST[ "local_id" ],
                ":edicao"      => $_POST[ "edicao" ],
                ":descricao"   => $_POST[ "descricao" ],
                ":data_inicio" => $data_inicio->format( "Y-m-d" ),
                ":data_fim"    => $data_fim->format( "Y-m-d" )
            ];

            if ( isset( $_POST[ "id" ] ) && is_numeric( $_POST[ "id" ] ) ) {

                $dados = array_merge( [ ":id" => $_POST[ "id" ] ], $dados );

                EventosControl::update( $dados );

            } else {

                EventosControl::insert( $dados );

            }

            header( "Location: index.php?page=ListagemEventos" );

            break;

        case "editar":

            $dados = EventosControl::selectOne( $_GET[ "id" ] );

            foreach ( $dados as $dado ) {
                $editar = $dado;
            }

            break;
    }

}

?>

<section>

  <div class="row">

      <form class="col s12" action="index.php?page=FormularioEventos&acao=salvar" method="post">
        <input id="id" name="id" type="hidden" value="<?= isset( $editar[ "id" ] ) ? $editar[ "id" ] : NULL ?>">
        <div class="row">
          <div class="input-field col s12">
            <input id="nome" name="nome" type="text" class="validate" value="<?= isset( $editar[ "nome" ] ) ? $editar[ "nome" ] : NULL ?>">
            <label for="text">Nome</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <select id="local_id" name="local_id">
              <?php
              $dados = LocaisControl::selectAll();

              if( isset( $_GET[ "local_id" ] ) ) {

                  echo '<option value="" disabled>Selecione um local</option>';

                  foreach ( $dados as $dado ) {

                      if ( $dado[ "local_id" ] == $_GET[ "local_id" ] ) {
                          echo '<option value="' . $dado[ "id" ] . '" selected>' . $dado[ "nome" ] . '</option>';
                      } else {
                          echo '<option value="' . $dado[ "id" ] . '">' . $dado[ "nome" ] . '</option>';
                      }

                  }

              } else {

                  echo '<option value="" disabled selected>Selecione um local</option>';

                  foreach ( $dados as $dado ) {
                      echo '<option value="' . $dado[ "id" ] . '">' . $dado[ "nome" ] . '</option>';
                  }

              }

              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="edicao" name="edicao" type="text" class="validate" value="<?= isset( $editar[ "edicao" ] ) ? $editar[ "edicao" ] : NULL ?>">
            <label for="text">Edição</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="descricao" name="descricao" type="text" class="validate" value="<?= isset( $editar[ "descricao" ] ) ? $editar[ "descricao" ] : NULL ?>">
            <label for="text">Descrição</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="data_inicio" name="data_inicio" type="text" class="datepicker" value="<?php

            if ( isset( $editar[ "data_inicio" ] ) ) {

                $data_inicio = new DateTime( $editar[ "data_inicio" ] );
                echo $data_inicio->format('j F, Y');

            } else {

                echo "";

            }

            ?>">
            <label for="text">Data de Inicio</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="data_fim" name="data_fim" type="text" class="datepicker" value="<?php

            if ( isset( $editar[ "data_fim" ] ) ) {

                $data_fim = new DateTime( $editar[ "data_fim" ] );
                echo $data_fim->format('j F, Y');

            } else {

                echo "";

            }

            ?>">
            <label for="text">Data de Fim</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">salvar
            <i class="material-icons right">done</i>
        </button>
      </form>

    </div>

<section/>
