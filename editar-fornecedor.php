<h1> Editar Fornecedor</h1>
<?php
$sql = "SELECT * FROM fornecedores WHERE id=".$_REQUEST["id"];
$res = $conn->query($sql);
$row = $res->fetch_object();
?>
<form action="?page=salvar-forn" method="POST">
    <input type="hidden" name="acao" value="editar-forn">
    <input type="hidden" name="id" value="<?php print $row->id; ?>">
    <div class="mb-3">
        <label>Nome Empresarial</label>
        <input type="text" name="nome"
               value="<?php print $row->nome; ?>" class="form-control"></div>
    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="cnpj"
               value="<?php print $row->cnpj; ?>" class="form-control"></div>
    <div class="mb-3">
        <label>Razão Social</label>
        <input type="text" name="razao_soc"
               value="<?php print $row->razao_soc; ?>" class="form-control"></div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="text" name="email"
               value="<?php print $row->email; ?>" class="form-control"></div>
    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required></div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>