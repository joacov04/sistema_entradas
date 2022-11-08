<?php
include_once "connect.php";
// 0 => used; 1 => delete
// used (0) es un toggle
if(isset($_POST['action'], $_POST['token'])) {

    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);

    $sql = $conn->query("SELECT usada FROM ".$table." WHERE token='".$token."'");
    $usada = $sql->fetch_array(MYSQLI_ASSOC)['usada'];

    if($action == 0) {
        if($usada == 0) {
            $update = $conn->query("UPDATE ".$table." SET usada=1 WHERE token='".$token."'");
        } else {
            $update = $conn->query("UPDATE ".$table." SET usada=0 WHERE token='".$token."'");
        }
    } else if($action == 1) {
        $delete = $conn->query("DELETE FROM ".$table." WHERE token='".$token."'");
    }

}

?>
