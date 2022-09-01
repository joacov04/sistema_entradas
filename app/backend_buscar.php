<?php
include_once "connect.php";


if(isset($_POST['nombre']))
    $nombre = strip_tags($_POST['nombre']) ;
    $nombre = mysqli_real_escape_string($conn, $nombre);

    $sql = $conn->query("SELECT * FROM fdp WHERE nombre='".$nombre."' ");
    $row_cnt = $sql->num_rows;
    if($row_cnt > 0) {
        $row = $sql->fetch_array(MYSQLI_ASSOC);
        $nombre_encontrado = $row['nombre'];
        $token = $row['token'];
        $entrada_usada = $row['usada'];
        $vendedor = $row['vendedor'];
        if($entrada_usada == 1) {
            $valida = "Entrada no válida";
        } else $valida = "Entrada válida";
        echo "<a id='search'>".$nombre_encontrado." - ".$token." - ".$valida." - Vendedor: ".$vendedor." </a>";
    } else echo "No se encontro el nombre";

$cant_query = $conn->query("SELECT * FROM fdp");
$total_count = $cant_query->num_rows;
echo "<h2 id='qr'>QR generados: ".$total_count."</h2>";
?>
