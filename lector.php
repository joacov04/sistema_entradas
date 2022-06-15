<?php
include_once "connect.php";

if (isset($_GET['lector'])) {
    $token = mysqli_real_escape_string($conn, $_GET['lector']);

    $sql = $conn->query("SELECT * FROM `fdp` WHERE token ='".$token."' ");

    $row_cnt = $sql->num_rows;
    if ($row_cnt > 0) {
        $row = $sql->fetch_array(MYSQLI_ASSOC);
        echo $row['nombre'].'<br/>';
        echo $row['usada'];
    }

}


?>
