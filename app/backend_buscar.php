<?php
include_once "connect.php";


if(isset($_POST['nombre']))
    $nombre = strip_tags($_POST['nombre']) ;
    $nombre = mysqli_real_escape_string($conn, $nombre);

    $sql = $conn->query("SELECT * FROM fdp");
    $row_cnt = $sql->num_rows;
    while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
        $nombre = $row['nombre'];
        $token = $row['token'];
        $vendedor = $row['vendedor'];
        $row['usada'] == '0' ? $usada='SI' : $usada='NO';

        echo "<tr>";
        echo "<td>".$nombre."</td>";
        echo "<td>".$token."</td>";
        echo "<td>".$usada."</td>";
        echo "<td>".$vendedor."</td>";
        echo "</tr>";

    }

?>
