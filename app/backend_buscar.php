<?php
include_once "connect.php";


$sql = $conn->query("select * from bios_persons join bios_tokens on bios_persons.token=bios_tokens.token;");
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $nombre = $row['nombre'];
    $token = $row['qr_token'];
    $vendedor = $row['vendedor'];
    $mail = $row['mail'];
    $tel = $row['tel'];
    if($row['usada'] == '1') {
        $usada = 'SI';
        $accion = 'NO Usada';
    } else {
        $usada = 'NO';
        $accion = 'Usada';
            }

    if($row['vendedor'] == $_SERVER['PHP_AUTH_USER'] || $_SERVER['PHP_AUTH_USER'] == 'joaquin' || $_SERVER['PHP_AUTH_USER'] == 'feli' ) {
    echo "<tr>";
    echo "<td>".$nombre."</td>";
    echo "<td>".$token."</td>";
    echo "<td>".$usada."</td>";
    echo "<td>".$vendedor."</td>";
    if($_SERVER['PHP_AUTH_USER'] == 'joaquin' || $_SERVER['PHP_AUTH_USER'] == 'feli') {
        echo "<td>".$tel."</td>";
        echo "<td>".$mail."</td>";
        echo "<td><a class='accion used_action'>".$accion."</a></td>";
        echo "<td><a class='accion delete_action'>Eliminar</a></td>";
    }
    echo "</tr>";

}

?>
