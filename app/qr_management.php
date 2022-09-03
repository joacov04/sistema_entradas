<?php
include_once "connect.php";
// 0 => used; 1 => delete
// used (0) es un toggle
if(isset($_POST['action'], $_POST['token'])) {

    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);

    $sql = $conn->query("SELECT usada FROM fdp WHERE token='".$token."'");
    $usada = $sql->fetch_array(MYSQLI_ASSOC)['usada'];

    if($usada == 0) {
        $update = $conn->query("UPDATE fdp SET usada=1 WHERE token='".$token."'");
        echo $token;
    } else {
        $update = $conn->query("UPDATE fdp SET usada=0 WHERE token='".$token."'");
        echo $token;

    }

}

?>
