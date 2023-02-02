<?php

include_once "connect.php";
if(isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $sql = $conn->query("SELECT * FROM bios_persons WHERE qr_token='".$token."' ");

    $row_cnt = $sql->num_rows;
    if ($row_cnt > 0) {
        $row = $sql->fetch_array(MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        echo json_encode(2);
    }
}


?>
