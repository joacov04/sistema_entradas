<?php

include_once "connect.php";
if(isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $sql = $conn->query("UPDATE ".$table." SET USADA=1 WHERE token='".$token."' ");
}


?>
