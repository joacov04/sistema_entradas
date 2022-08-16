<?php
include_once "../app/connect.php";


$cant_query = $conn->query("SELECT * FROM fdp");
$total_count = $cant_query->num_rows;

echo $total_count;
?>
