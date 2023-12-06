<?php

// Certifique-se de que o carrinho exista na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verificar se a página foi recarregada (refresh)
if (isset($_SESSION['ultima_acao']) && $_SESSION['ultima_acao'] == $_SERVER['REQUEST_TIME']) {
    // Limpar o carrinho
    $_SESSION['carrinho'] = [];
    session_regenerate_id(true); // Regenerar o ID da sessão
}

// Atualizar o timestamp da última ação
$_SESSION['ultima_acao'] = $_SERVER['REQUEST_TIME'];

// Adicionar produto ao carrinho
if (isset($_POST['add_to_cart'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Verificar se o produto já está no carrinho
    $produto_existente = array_filter($_SESSION['carrinho'], function($item) use ($produto_id) {
        return $item['id'] == $produto_id;
    });

    if (!empty($produto_existente)) {
        // O produto já está no carrinho, você pode atualizar a quantidade se necessário
        echo "Produto já está no carrinho.";
    } else {
        // Verificar se há estoque suficiente
        $query = "SELECT nome, preco, estoque FROM produtos WHERE id = $produto_id";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $estoque_disponivel = $row['estoque'];

            if ($estoque_disponivel >= $quantidade) {
                // Adicionar ao carrinho
                $produto = [
                    'id' => $produto_id,
                    'quantidade' => $quantidade,
                    'preco' => $row['preco'],
                    'nome' => $row['nome']
                ];

                $_SESSION['carrinho'][] = $produto;
                echo "Produto adicionado ao carrinho.";
            } else {
                echo "Estoque insuficiente!";
            }
        }
    }
}
// Atualizar a quantidade do item no carrinho
if (isset($_POST['atualizar_quantidade'])) {
    $produto_id = $_POST['produto_id'];
    $nova_quantidade = $_POST['nova_quantidade'];

    // Encontrar o item no carrinho
    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['id'] == $produto_id) {
            // Atualizar a quantidade
            $item['quantidade'] = $nova_quantidade;
            break;
        }
    }

    echo "Quantidade atualizada.";
}
// Remover item do carrinho
if (isset($_POST['remover_item'])) {
    $produto_id = $_POST['produto_id'];

    // Filtrar o carrinho para remover o item
    $_SESSION['carrinho'] = array_filter($_SESSION['carrinho'], function ($item) use ($produto_id) {
        return $item['id'] != $produto_id;
    });

    echo "Item removido do carrinho.";
}
// Função para calcular o valor total do carrinho
function calcularValorTotalCarrinho($carrinho) {
    $valorTotal = 0;

    foreach ($carrinho as $item) {
        $valorTotal += $item['quantidade'] * $item['preco'];
    }

    return $valorTotal;
}

// Exibir produtos
$query = "SELECT * FROM produtos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>PDV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #3498db;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        form {
            display: inline-block;
        }

        input[type="number"] {
            width: 50px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 8px;
            border: none;
            cursor: pointer;
        }

        p {
            margin-top: 10px;
        }

        /* Estilo para a mensagem de "Quantidade atualizada" */
        .mensagem {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(46, 204, 113, 0.7); /* Fundo verde com transparência */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #fff;
            z-index: 9999; /* Garante que a mensagem esteja sobre todos os elementos da página */
            display: none;
        }
    </style>
</head>
<body>

<h2>Produtos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ação</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nome']}</td>";
        echo "<td>R$ {$row['preco']}</td>";
        echo "<td>{$row['estoque']}</td>";
        echo "<td>
                <form method='post' action='?page=pdv'>
                    <input type='hidden' name='produto_id' value='{$row['id']}'>
                    <input type='number' name='quantidade' value='1' min='1' max='{$row['estoque']}'>
                    <input type='submit' name='add_to_cart' value='Adicionar ao Carrinho'>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>

<h2>Carrinho</h2>

<?php
// Exibir o carrinho
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    echo "<table>";
    echo "<tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Total</th><th>Ação</th></tr>";

    foreach ($_SESSION['carrinho'] as $item) {
        $total_item = $item['quantidade'] * $item['preco'];
        echo "<tr>";
        echo "<td>{$item['nome']}</td>";
        echo "<td>
                <form method='post' action='?page=pdv'>
                    <input type='hidden' name='produto_id' value='{$item['id']}'>
                    <input type='number' name='nova_quantidade' value='{$item['quantidade']}' min='1' max='100'>
                    <input type='submit' name='atualizar_quantidade' value='Atualizar'>
                </form>
              </td>";
        echo "<td>R$ {$item['preco']}</td>";
        echo "<td>R$ {$total_item}</td>";
        echo "<td>
                <form method='post' action='?page=pdv'>
                    <input type='hidden' name='produto_id' value='{$item['id']}'>
                    <input type='submit' name='remover_item' value='Remover'>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "</table>";

    // Exibir o valor total do carrinho
    $valorTotalCarrinho = calcularValorTotalCarrinho($_SESSION['carrinho']);
    echo "<p>Valor Total do Carrinho: R$ " . number_format($valorTotalCarrinho, 2, ',', '.') . "</p>";

    echo "<form method='post' action='?page=fin_compra'>
        <input type='submit' name='finalizar_compra' value='Finalizar Compra'>
      </form>";

    // Exibir a mensagem de "Quantidade atualizada" se necessário
    if (isset($_SESSION['mensagem_quantidade_atualizada'])) {
        echo "<div class='mensagem'>{$_SESSION['mensagem_quantidade_atualizada']}</div>";
        unset($_SESSION['mensagem_quantidade_atualizada']); // Limpar a mensagem após exibição
    }
} else {
    echo "<p>Carrinho vazio.</p>";
}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
