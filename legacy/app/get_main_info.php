<?php
include_once "connect.php";

$user = $_SERVER['PHP_AUTH_USER'];
if ($user != 'joaquin' && $user != 'feli') {
    return;
}

$MARGIN_PERCENT = 0.1;

$sql = $conn->query("SELECT sum(cantidad) AS Total FROM bios_tokens");
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $total_entradas = $row['Total'];
    $total_plata = "$".number_format(((int)$total_entradas)*$PRICE);
    $costo_publicas = "$".number_format((int)$total_entradas*$FEE);
    $neto = "$".number_format((int)$total_entradas*($PRICE-$FEE));

    $info = [
        "entradas"  => $total_entradas,
        "plata"     => $total_plata,
        "margen"    => $costo_publicas,
        "neto"      => $neto,
    ];

    echo json_encode($info);

}

?>
