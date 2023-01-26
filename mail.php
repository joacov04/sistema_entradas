<?php

include_once "app/connect.php";

$quer = "SELECT * FROM bios_persons";
$sql = $conn->query($quer);
$row_cnt = $sql->num_rows;
while($row = $sql->fetch_array(MYSQLI_ASSOC)) {
    $email = $row['email'];
    $qr_token = $row['qr_token'];

    $to = $email; 
    $subject = 'BIOS - Reencuentro de la costa';
    $headers = "From: BIOS Producciones <BIOS@jva.com.ar>"."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = "
    <h2>BIOS - Tu entrada</h2>
    <p>Hola ".$nombre.", Gracias por tu compra! Tu QR fue creado correctamente.</p>

    <p>Te esperamos el 28/1!</p>
    <img src='https://chart.googleapis.com/chart?chs=250x250&amp;cht=qr&amp;chl=".$qr_token."&amp;chld=L|1'>
    <p>Metropolitano Rosario - Ingreso por esquina Echeverria y Central Argentino (Lotus)</p>
    ";

    mail($to, $subject, $message, $headers);

}
?>
