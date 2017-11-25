<section>

    <table class="bordered">

        <thead>
          <tr>
              <th></th>
              <th>Nome</th>
              <th>Município</th>
              <th>Bairro</th>
              <th>Endereço</th>
          </tr>
        </thead>

        <?php

        require_once "controls/LocaisControl.php";

        if ( isset( $_GET[ "acao" ] ) && $_GET[ "acao" ] == "deletar" ) {
            LocaisControl::delete( $_GET[ "id" ] );
        }

        $dados = LocaisControl::selectAll();

        ?>

        <tbody>
            <?php foreach( $dados as $dado ): ?>
                <tr>
                    <td>
                        <a class='dropdown-button btn' href='#' data-activates='dropdown<?= $dado['id'] ?>'>opções</a>
                        <ul id='dropdown<?= $dado['id'] ?>' class='dropdown-content'>
                            <li><a href="index.php?page=FormularioLocais&acao=editar&id=<?= $dado['id'] ?>"><i class="material-icons">edit</i>editar</a></li>
                            <li><a href="index.php?page=ListagemLocais&acao=deletar&id=<?= $dado['id'] ?>"><i class="material-icons">delete</i>deletar</a></li>
                        </ul>
                    </td>
                    <td><?= $dado['nome'] ?></td>
                    <td><?= $dado['municipio'] ?></td>
                    <td><?= $dado['bairro'] ?></td>
                    <td><?= $dado['endereco'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

      </table>
      
</section>
