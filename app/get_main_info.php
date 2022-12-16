<?php
include_once "connect.php";

$user = $_SERVER['PHP_AUTH_USER'];
if ($user != 'joaquin' && $user != 'payo') {
    return;
}

$MARGIN_PERCENT = 0.1;

$sql = $conn->query("SELECT COUNT(*) AS Total FROM ".$table);
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $total_entradas = $row['Total'];
    $total_plata = number_format(((int)$total)*1000);
    array();


}

?>
