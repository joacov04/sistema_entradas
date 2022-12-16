<?php
include_once "connect.php";


$sql = $conn->query("SELECT vendedor, COUNT(*) AS Total FROM ".$table." GROUP BY vendedor ORDER BY Total DESC");
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $total = $row['Total'];
    $vendedor = $row['vendedor'];
    $total_plata = number_format(((int)$total)*1000);

    echo "<tr>";
    echo "<td>".$vendedor."</td>";
    echo "<td>".$total."</td>";
    echo "<td>".$total_plata."</td>";
    echo "</tr>";

}

?>
