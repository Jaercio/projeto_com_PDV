<?php
include ("config.php");
session_start();
if(empty($_SESSION)){
    print "<script>location.href='index.php';</script>";
}


?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Estoque</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/framework.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">

    <link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=novo">Novo Usuário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=listar">Listar Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=novo-prod">Novo Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=listar-prod">Listar Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=novo-forn">Novo Fornecedor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=listar-forn">Listar Fornecedor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pdv">Vender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="relatorio.php">Baixar Posição do Estoque</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<?php
    print "<h1>Olá, <b>" .$_SESSION["nome"]. "</b> </h1><br>";
    print "<a href='logout.php' class='btn btn-danger'>Sair</a>";


?>

<div class="container">
    <div class="row">
        <div class="col mt-5">
            <?php

            switch (@$_REQUEST["page"]){
                case "novo":
                    include("novo-usuario.php");
                    break;
                case "listar":
                    include("listar-usuario.php");
                    break;
                case "salvar":
                    include("salvar-usuario.php");
                    break;
                case "editar":
                    include("editar-usuario.php");
                    break;
                case "novo-prod":
                    include("novo-produto.php");
                    break;
                case "listar-prod":
                    include("listar-produto.php");
                    break;
                case "salvar-prod":
                    include("salvar-produto.php");
                    break;
                case "editar-prod":
                    include("editar-produto.php");
                    break;
                case "novo-forn":
                    include("novo-fornecedor.php");
                    break;
                case "listar-forn":
                    include("listar-fornecedores.php");
                    break;
                case "salvar-forn":
                    include("salvar-fornecedor.php");
                    break;
                case "editar-forn":
                    include("editar-fornecedor.php");
                    break;
                case "pdv":
                    include("pdv.php");
                    break;
                case "fin_compra":
                    include("finalizar_compra.php");
                    break;
                default:
                    print "<h1>Bem vindo!</h1>";
            }

            ?>
        </div>
    </div>
</div>
<?php

// Consulta SQL para contar o número de clientes por tipo
$sql = "SELECT tipo, COUNT(*) as total FROM usuarios GROUP BY tipo";
$result = mysqli_query($conn, $sql);

// Inicializar arrays para armazenar dados
$tipos = [];
$totalClientes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $tipos[] = $row['tipo'];
    $totalClientes[] = $row['total'];
}

// Converta os arrays para formatos que podem ser usados em JavaScript
$tiposJson = json_encode($tipos);
$totalClientesJson = json_encode($totalClientes);
?>

<div style="width: 60%; margin: auto;">
    <canvas id="barChart" width="300" height="100"></canvas>
</div>


<script>
    // Dados obtidos do PHP
    var tipos = <?php echo $tiposJson; ?>;
    var totalClientes = <?php echo $totalClientesJson; ?>;

    // Configurar o gráfico de barras
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tipos,
            datasets: [{
                label: 'Número de Clientes',
                data: totalClientes,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
