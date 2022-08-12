<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/lector.css">
    <script src="src/jquery.js"></script>
    <script src="src/lector.js"></script>
    <title>Sistema QR</title>
</head>
<body class="nousada" id="body">

<?php

include_once "connect.php";

if (isset($_GET['lector'])) {
    $token = mysqli_real_escape_string($conn, $_GET['lector']);

    $sql = $conn->query("SELECT * FROM `fdp` WHERE token ='".$token."' ");

    $row_cnt = $sql->num_rows;
    if ($row_cnt > 0) {
        $row = $sql->fetch_array(MYSQLI_ASSOC);
        echo '<h1>'.$row['nombre'].'</h1><br/>';
        echo "<h5 id='valor'>".$row['usada'].'</h5>';
        echo "<h5 id='token'>".$token.'</h5>';
        echo "<a id='boton'>USADA</a>";
    } else {
        echo "<h1 id='invalid'>ENTRADA INVALIDA</h1>";
        echo "<h3>PROCEDE PATADA EN EL CULO</h3>";
    }

}


?>
</body>
</html>
