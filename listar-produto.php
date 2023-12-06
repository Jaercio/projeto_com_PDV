<h1> Listar Produto</h1>

<?php

$sql = "SELECT * FROM produtos";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if($qtd > 0){
    print "<table class='table table-hover table-bordered 
table-striped'>";
    print "<tr>";
    print "<th>Codigo</th>";
    print "<th>Descricao</th>";
    print "<th>Preco</th>";
    print "<th>Quantidade</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while($row = $res->fetch_object()){

        print "<tr>";
        print "<td>".$row->id."</td>";
        print "<td>".$row->nome."</td>";
        print "<td>".$row->preco."</td>";
        print "<td>".$row->estoque."</td>";
        print "<td>
    <button onclick=\"location.href='?page=editar-prod&id=".$row->id."';\"   class='btn btn-success'>Editar</button>
    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){
    location.href='?page=salvar-prod&acao=excluir-prod&id=".$row->id."';
    }else{false;}\" class='btn btn-danger'>Excluir</button>


</td>";
        if ($row->estoque < 5) {
            echo "<script>alert('Produto com ID: ".$row->id." está acabando!');</script>";
        }
        print "</tr>";
    }
    print "</table>";
}else{
    print "<p class='alert alert-danger'>
        Não foram encontrados resultados</p>";
}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
