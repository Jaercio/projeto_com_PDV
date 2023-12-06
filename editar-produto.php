<h1> Editar Produto</h1>
<?php
$sql = "SELECT * FROM produtos WHERE id=".$_REQUEST["id"];
$res = $conn->query($sql);
$row = $res->fetch_object();
?>
<form action="?page=salvar-prod" method="POST">
    <input type="hidden" name="acao" value="editar-prod">
    <input type="hidden" name="id" value="<?php print $row->id; ?>">
    <div class="mb-3">
        <label>Descricao</label>
        <input type="text" name="nome"
               value="<?php print $row->nome; ?>" class="form-control"></div>
    <div class="mb-3">
        <label>Preco</label>
        <input type="text" name="preco"
               value="<?php print $row->preco; ?>" class="form-control" ></div>
    <div class="mb-3">
        <label>Quantidade</label>
        <input type="text" name="estoque"
               value="<?php print $row->estoque; ?>" class="form-control"></div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>