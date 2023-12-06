<?php

// Finalizar a compra
if (isset($_POST['finalizar_compra']) && isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    // Inserir dados na tabela de vendas
    $total_geral = 0;

    $query = "INSERT INTO vendas (data_venda, total_venda) VALUES (NOW(), 0)";
    $conn->query($query);
    $venda_id = $conn->insert_id;

    foreach ($_SESSION['carrinho'] as $item) {
        $total_item = $item['quantidade'] * $item['preco'];
        $total_geral += $total_item;

        // Inserir dados na tabela de itens_venda
        $query = "INSERT INTO itens_venda (venda_id, produto_id, nome_produto ,quantidade, preco_unitario, total_item) VALUES ('$venda_id', '{$item['id']}', '{$item['nome']}','{$item['quantidade']}', '{$item['preco']}', '$total_item')";
        $conn->query($query);

        // Atualizar estoque na tabela de produtos
        $query = "UPDATE produtos SET estoque = estoque - {$item['quantidade']} WHERE id = {$item['id']}";
        $conn->query($query);
    }

    // Atualizar total da venda na tabela de vendas
    $query = "UPDATE vendas SET total_venda = $total_geral WHERE id = $venda_id";
    $conn->query($query);

    // Limpar carrinho
    unset($_SESSION['carrinho']);

    echo "Compra finalizada com sucesso!";
} else {
    echo "Erro ao finalizar a compra.";
}
?>
