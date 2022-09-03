<?php
include_once "connect.php";


$nombre = mysqli_real_escape_string($conn, $nombre);

$sql = $conn->query("SELECT * FROM fdp");
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $nombre = $row['nombre'];
    $token = $row['token'];
    $vendedor = $row['vendedor'];
    if($row['usada'] == '1') {
        $usada = 'SI';
        $accion = 'NO Usada';
    } else {
        $usada = 'NO';
        $accion = 'Usada';
    }

    echo "<tr>";
    echo "<td>".$nombre."</td>";
    echo "<td>".$token."</td>";
    echo "<td>".$usada."</td>";
    echo "<td>".$vendedor."</td>";
    echo "<td><a class='accion used_action'>".$accion."</a></td>";
    echo "</tr>";

}

?>
