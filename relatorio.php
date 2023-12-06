<?php
include("config.php");

$sql = "SELECT * FROM produtos";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    $html = "<h1>Posição de Estoque Atual</h1>";
    $html .= "<table border='1'>";
    $html .= "<thead><tr><th>Código</th><th>Descrição</th><th>Preço</th><th>Quantidade</th></tr></thead>";
    $html .= "<tbody>";

    while ($row = $res->fetch_object()) {
        $html .= "<tr>";
        $html .= "<td>" . $row->id . "</td>";
        $html .= "<td>" . $row->nome . "</td>";
        $html .= "<td>" . $row->preco . "</td>";
        $html .= "<td>" . $row->estoque . "</td>";
        $html .= "</tr>";
    }

    $html .= "</tbody></table>";
} else {
    $html = 'Nenhum dado registrado';
}

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_option('defaultFont', 'sans');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();
