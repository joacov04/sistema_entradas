<?php
include_once "../app/connect.php";


$cant_query = $conn->query("SELECT sum(cantidad) AS Total FROM bios_tokens");
$total_count = $cant_query->fetch_assoc();

echo $total_count['Total'];
?>
