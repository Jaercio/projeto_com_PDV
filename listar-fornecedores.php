<h1> Listar Fornecedor</h1>

<?php

$sql = "SELECT * FROM fornecedores";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if($qtd > 0){
    print "<table class='table table-hover table-bordered 
table-striped'>";
    print "<tr>";
    print "<th>ID</th>";
    print "<th>Nome</th>";
    print "<th>E-mail</th>";
    print "<th>CNPJ</th>";
    print "<th>Razão Social</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while($row = $res->fetch_object()){
        print "<tr>";
        print "<td>".$row->id."</td>";
        print "<td>".$row->nome."</td>";
        print "<td>".$row->email."</td>";
        print "<td>".$row->cnpj."</td>";
        print "<td>".$row->razao_soc."</td>";
        print "<td>
    <button onclick=\"location.href='?page=editar-forn&id=".$row->id."';\"   class='btn btn-success'>Editar</button>
    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){
    location.href='?page=salvar-forn&acao=excluir-forn&id=".$row->id."';
    }else{false;}\" class='btn btn-danger'>Excluir</button>


</td>";
        print "</tr>";


    }

    print "</table>";
}else{
    print "<p class='alert alert-danger'>
        Não foram encontrados resultados</p>";
}
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
