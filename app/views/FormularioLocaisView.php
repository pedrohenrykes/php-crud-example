<?php

use App\Controllers\LocaisControl;

$editar = [];

if ( isset( $_GET[ "acao" ] ) ) {

    switch( $_GET[ "acao" ] ) {

        case "salvar":

            $dados = [
                ":nome"      => $_POST[ "nome" ],
                ":municipio" => $_POST[ "municipio" ],
                ":bairro"    => $_POST[ "bairro" ],
                ":endereco"  => $_POST[ "endereco" ]
            ];

            if ( isset( $_POST[ "id" ] ) && is_numeric( $_POST[ "id" ] ) ) {

                $dados = array_merge( [ ":id" => $_POST[ "id" ] ], $dados );

                LocaisControl::update( $dados );

            } else {

                LocaisControl::insert( $dados );

            }

            header( "Location: index.php?page=ListagemLocais" );

            break;

        case "editar":

            $dados = LocaisControl::selectOne( $_GET[ "id" ] );

            foreach ( $dados as $dado ) {
                $editar = $dado;
            }

            break;
    }

}

?>

<section>

  <div class="row">

      <form class="col s12" action="index.php?page=FormularioLocais&acao=salvar" method="post">
        <input id="id" name="id" type="hidden" value="<?= isset( $editar[ "id" ] ) ? $editar[ "id" ] : NULL ?>">
        <div class="row">
          <div class="input-field col s12">
            <input id="nome" name="nome" type="text" class="validate" value="<?= isset( $editar[ "nome" ] ) ? $editar[ "nome" ] : NULL ?>">
            <label for="text">Nome</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="municipio" name="municipio" type="text" class="validate" value="<?= isset( $editar[ "municipio" ] ) ? $editar[ "municipio" ] : NULL ?>">
            <label for="text">Município</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="bairro" name="bairro" type="text" class="validate" value="<?= isset( $editar[ "bairro" ] ) ? $editar[ "bairro" ] : NULL ?>">
            <label for="text">Bairro</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="endereco" name="endereco" type="text" class="validate" value="<?= isset( $editar[ "endereco" ] ) ? $editar[ "endereco" ] : NULL ?>">
            <label for="text">Endereço</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">salvar
            <i class="material-icons right">done</i>
        </button>
      </form>

    </div>

<section/>
