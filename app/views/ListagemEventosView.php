<section>

    <div class="row">

      <div class="row">
        <table class="bordered">

        <thead>
          <tr>
              <th></th>
              <th>Nome</th>
              <th>Local</th>
              <th>Edição</th>
              <th>Descrição</th>
              <th>Data de Início</th>
              <th>Data de Fim</th>
          </tr>
        </thead>

        <?php

        use App\Controllers\EventosControl;
        use App\Controllers\LocaisControl;

        if ( isset( $_GET[ "acao" ] ) && $_GET[ "acao" ] == "deletar" ) {
            EventosControl::delete( $_GET[ "id" ] );
        }

        $dados = EventosControl::selectAll();

        ?>

        <tbody>
            <?php foreach( $dados as $dado ): ?>
                <tr>
                    <td>
                      <a class='dropdown-button btn' href='#' data-activates='dropdown<?= $dado['id'] ?>'><i class="material-icons">reorder</i></a>
                      <ul id='dropdown<?= $dado['id'] ?>' class='dropdown-content'>
                        <li><a href="index.php?page=FormularioEventos&acao=editar<?= "&id=" . $dado['id'] . "&local_id=" . $dado['local_id'] ?>">Editar</a></li>
                        <li><a href="index.php?page=ListagemEventos&acao=deletar<?= "&id=" . $dado['id'] ?>">Apagar</a></li>
                      </ul>
                    </td>
                    <td><?= $dado['nome'] ?></td>
                    <td>
                        <?php
                        $locais = LocaisControl::selectOne( $dado[ "local_id" ] );
                        foreach ( $locais as $local ) {
                            echo $local[ "nome" ];
                        }
                        ?>
                    </td>
                    <td><?= $dado['edicao'] ?></td>
                    <td><?= $dado['descricao'] ?></td>
                    <td>
                        <?php
                        $data_inicio = new DateTime( $dado[ "data_inicio" ] );
                        echo $data_inicio->format('d/m/Y');
                        ?>
                    </td>
                    <td>
                        <?php
                        $data_fim = new DateTime( $dado[ "data_fim" ] );
                        echo $data_fim->format('d/m/Y');
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

      </table>
      </div>

      <div class="row">
        <a class="waves-effect waves-light btn green" href="index.php?page=FormularioEventos">
          <i class="material-icons right">add</i>novo
        </a>
      </div>

    </div>

</section>
