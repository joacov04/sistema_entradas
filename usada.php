<?php

include_once "connect.php";
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = $conn->query("UPDATE fdp SET USADA=1 WHERE token='".$token."' ");
}


?>
