<div class="container">

    <h2>Formas de Pagamento</h2>
    <div class="mb-3">
        <a href="forma_pagamento.php?page=novo" class="btn btn-primary"> Adicionar Forma de Pagamento</a>
    </div>

    <?php
    $sql = "SELECT * FROM forma_pagamento";
    $res = $conexao->query($sql);
    $qtd = $res->num_rows;

    if ($qtd > 0) {

        print "<table class='table table-bordered'>";
        print "<thead class='thead-dark'";
        print "<tr>";
        print "<th>ID</th>";
        print "<th>Nome</th>";
        print "<th>Tipo</th>";
        print "<th>Aceita Parcelamento</th>";
        print "<th>Prazo da Parcela</th>";
        print "<th>Juros</th>";
        print "<th>Ações</th>";
        print "</tr";
        print "</thead>";
        print "<tbody>";

        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . $row->id_pagamento . "</td>";
            print "<td>" . $row->nome . "</td>";
            print "<td>" . $row->tipo . "</td>";
            print "<td>" . ($row->aceita_parcelamento == 1 ? 'Sim' : 'Não') . "</td>";
            print "<td>" . $row->prazo_parcela . "</td>";
            print "<td>" . $row->juros . "</td>";
            print "<td>";
            print "<button onclick=\"location.href='?page=editar&id=" . $row->id_pagamento . "';\" class='btn btn-warning'>Editar</button> ";
            print "<button onclick=\"if(confirm('Tem certeza que deseja excluir esta forma de pagamento?'))
                {location.href='?page=excluir&id=" . $row->id_pagamento . "';}\" class='btn btn-danger'>Excluir</button>";
        }
        print "</tbody>";
        print "</table>";

    } else {
        print "<div class='alert alerg-danger' role='alert'>Não foram encontrados formas de pagamento</div>";
    }
    ?>

</div>