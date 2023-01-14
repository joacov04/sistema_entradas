<?php
include_once "connect.php";


$sql = $conn->query("select vendedor, sum(cantidad) as Total from bios_tokens group by vendedor order by Total desc;");
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $total = $row['Total'];
    $vendedor = $row['vendedor'];
    $total_plata = number_format(((int)$total)*$PRICE);

    echo "<tr>";
    echo "<td>".$vendedor."</td>";
    echo "<td>".$total."</td>";
    echo "<td>".$total_plata."</td>";
    echo "</tr>";

}

?>
