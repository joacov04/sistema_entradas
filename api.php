<?php
include_once "connect.php";


$cant_query = $conn->query("SELECT * FROM fdp");
$total_count = $cant_query->num_rows - 20;

echo $total_count;
?>