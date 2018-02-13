<section>

    <div class="row">

      <div class="row">
        <table class="bordered">

        <thead>
          <tr>
              <th></th>
              <th>Nome</th>
              <th>Evento</th>
              <th>Descrição</th>
              <th>Data de Realização</th>
              <th>Horário de Início</th>
              <th>Horário de Fim</th>
          </tr>
        </thead>

        <?php

        use App\Controllers\ProgramacoesControl;
        use App\Controllers\EventosControl;

        if ( isset( $_GET[ "acao" ] ) && $_GET[ "acao" ] == "deletar" ) {
            ProgramacoesControl::delete( $_GET[ "id" ] );
        }

        $dados = ProgramacoesControl::selectAll();

        ?>

        <tbody>
            <?php foreach( $dados as $dado ): ?>
                <tr>
                    <td>
                      <a class='dropdown-button btn' href='#' data-activates='dropdown<?= $dado['id'] ?>'><i class="material-icons">reorder</i></a>
                      <ul id='dropdown<?= $dado['id'] ?>' class='dropdown-content'>
                        <li><a href="index.php?page=FormularioProgramacoes&acao=editar<?= "&id=" . $dado['id'] . "&evento_id=" . $dado['evento_id'] ?>">Editar</a></li>
                        <li><a href="index.php?page=ListagemProgramacoes&acao=deletar<?= "&id=" . $dado['id'] ?>">Apagar</a></li>
                      </ul>
                    </td>
                    <td><?= $dado['nome'] ?></td>
                    <td>
                        <?php
                        $eventos = EventosControl::selectOne( $dado[ "evento_id" ] );
                        foreach ( $eventos as $evento ) {
                            echo $evento[ "nome" ];
                        }
                        ?>
                    </td>
                    <td><?= $dado['descricao'] ?></td>
                    <td>
                        <?php
                        $data_inicio = new DateTime( $dado[ "data_evento" ] );
                        echo $data_inicio->format('d/m/Y');
                        ?>
                    </td>
                    <td>
                        <?php
                        $data_inicio = new DateTime( $dado[ "hora_inicio" ] );
                        echo $data_inicio->format('H:i');
                        ?>
                    </td>
                    <td>
                        <?php
                        $data_fim = new DateTime( $dado[ "hora_fim" ] );
                        echo $data_fim->format('H:i');
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

      </table>
      </div>

      <div class="row">
        <a class="waves-effect waves-light btn green" href="index.php?page=FormularioProgramacoes">
          <i class="material-icons right">add</i>novo
        </a>
      </div>

    </div>

</section>
