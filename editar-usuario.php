<h1>Editar Usuário</h1>

<?php
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];

    // Utilizando declaração preparada para evitar injeção de SQL
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_object();
            ?>





            <form action="?page=salvar" method="POST">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row->id); ?>">

                <div class="mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($row->nome); ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($row->email); ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" name="data_nasc" value="<?php echo htmlspecialchars($row->data_nasc); ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>


            <?php
        } else {
            echo "Nenhum usuário encontrado com o ID fornecido.";
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta.";
    }
} else {
    echo "ID não fornecido.";
}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>