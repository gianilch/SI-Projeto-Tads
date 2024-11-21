<div class="container">

<h2> Lista de Usuários</h2>
<div class="mb-3">
    <a href="usuario.php?page=novo" 
    class="btn btn-primary"> Adicionar Usuário</a>
</div>

    <?php 
        $sql = "SELECT * FROM usuario";
        $res = $conexao->query($sql);
        $qtd = $res->num_rows;
    
        if($qtd > 0){
        
           print "<table class='table table-bordered'>";
           print "<thead class='thead-dark'";
           print "<tr>"; 
           print "<th>ID</th>";
           print "<th>Nome</th>";
           print "<th>Email</th>";
           print "<th>Ações</th>";
           print "</tr";
           print "</thead>";
           print "<tbody>";

           while($row = $res->fetch_object()){
            print "<tr>";
            print "<td>" .$row->id . "</td>";
            print "<td>" .$row->nome . "</td>";
            print "<td>" .$row->email . "</td>";
            print "<td>";
            
            print "<button onclick=\"location.href='?page=visualizar&id=" . $row->id . "';\" class='btn btn-info'>Visualizar</button>";

             print "<button onclick=\"location.href='?page=visualizar&id=" . $row->id . "';\" class='btn btn-info'>Visualizar</button> ";
                print "<button onclick=\"location.href='?page=editar&id=" . $row->id . "';\" class='btn btn-warning'>Editar</button> ";
                print "<button onclick=\"if(confirm('Tem certeza que deseja excluir este usuário?'))
                {location.href='?page=excluir&id=" . $row->id . "';}\" class='btn btn-danger'>Excluir</button>";

           }
             print "</tbody>";
             print "</table>";
        
        }else{
            print "<div class='alert alerg-danger' role='alert'>Não foram encontrados usuários</div>";
        }
    ?>

</div>
