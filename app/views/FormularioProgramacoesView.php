<?php

use App\Controllers\EventosControl;
use App\Controllers\ProgramacoesControl;

$editar = [];

if ( isset( $_GET[ "acao" ] ) ) {

    switch( $_GET[ "acao" ] ) {

        case "salvar":

            $hora_inicio = new DateTime( $_POST[ "hora_inicio" ] );
            $hora_fim    = new DateTime( $_POST[ "hora_fim" ] );

            $dados = [
                ":nome"        => $_POST[ "nome" ],
                ":evento_id"    => $_POST[ "evento_id" ],
                ":descricao"   => $_POST[ "descricao" ],
                ":data_evento" => $hora_inicio->format( "Y-m-d" ),
                ":hora_inicio" => $hora_inicio->format( "H:i" ),
                ":hora_fim"    => $hora_fim->format( "H:i" )
            ];

            if ( isset( $_POST[ "id" ] ) && is_numeric( $_POST[ "id" ] ) ) {

                $dados = array_merge( [ ":id" => $_POST[ "id" ] ], $dados );

                ProgramacoesControl::update( $dados );

            } else {

                ProgramacoesControl::insert( $dados );

            }

            header( "Location: index.php?page=ListagemProgramacoes" );

            break;

        case "editar":

            $dados = ProgramacoesControl::selectOne( $_GET[ "id" ] );

            foreach ( $dados as $dado ) {
                $editar = $dado;
            }

            break;
    }

}

?>

<section>

  <div class="row">

      <form class="col s12" action="index.php?page=FormularioProgramacoes&acao=salvar" method="post">
        <input id="id" name="id" type="hidden" value="<?= isset( $editar[ "id" ] ) ? $editar[ "id" ] : NULL ?>">
        <div class="row">
          <div class="input-field col s12">
            <input id="nome" name="nome" type="text" class="validate" value="<?= isset( $editar[ "nome" ] ) ? $editar[ "nome" ] : NULL ?>">
            <label for="text">Nome</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <select id="evento_id" name="evento_id">
              <?php
              $dados = EventosControl::selectAll();

              if( isset( $_GET[ "evento_id" ] ) ) {

                  echo '<option value="" disabled>Selecione um local</option>';

                  foreach ( $dados as $dado ) {

                      if ( $dado[ "evento_id" ] == $_GET[ "evento_id" ] ) {
                          echo '<option value="' . $dado[ "id" ] . '" selected>' . $dado[ "nome" ] . '</option>';
                      } else {
                          echo '<option value="' . $dado[ "id" ] . '">' . $dado[ "nome" ] . '</option>';
                      }

                  }

              } else {

                  echo '<option value="" disabled selected>Selecione um evento</option>';

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
            <input id="descricao" name="descricao" type="text" class="validate" value="<?= isset( $editar[ "descricao" ] ) ? $editar[ "descricao" ] : NULL ?>">
            <label for="text">Descrição</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="data_evento" name="data_evento" type="text" class="datepicker" value="<?php

            if ( isset( $editar[ "data_evento" ] ) ) {

                $data_evento = new DateTime( $editar[ "data_evento" ] );
                echo $data_evento->format('j F, Y');

            } else {

                echo "";

            }

            ?>">
            <label for="text">Data do Evento</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="hora_inicio" name="hora_inicio" type="text" class="timepicker" placeholder="Horário de inicio" value="<?php

            if ( isset( $editar[ "hora_inicio" ] ) ) {

                $hora_inicio = new DateTime( $editar[ "hora_inicio" ] );
                echo $hora_inicio->format('g:iA');

            } else {

                echo "";

            }

            ?>">
            <!--<label for="text">Horário de Inicio</label>-->
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="hora_fim" name="hora_fim" type="text" class="timepicker" placeholder="Horário de fim" value="<?php

            if ( isset( $editar[ "hora_fim" ] ) ) {

                $hora_fim = new DateTime( $editar[ "hora_fim" ] );
                echo $hora_fim->format('g:iA');

            } else {

                echo "";

            }

            ?>">
            <!--<label for="text">Horário de Fim</label>-->
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">salvar
            <i class="material-icons right">done</i>
        </button>
      </form>

    </div>

<section/>
