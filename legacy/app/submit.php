<?php
include_once "connect.php";


function generateRandomString($length = 45) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
        for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function cleanDir($dir) {
    if($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != ".") {
                system('mv '.$dir.$entry.' qrUsados');
            }
        }
        closedir($handle);
    }
}

if(isset($_POST['cant'])){
    $cant = $_POST['cant'];
    $rand_token = generateRandomString(45);

    $secure_cant = mysqli_real_escape_string($conn, $cant);
    $seller = $_SERVER['PHP_AUTH_USER'];
    $quer = "INSERT INTO bios_tokens (token, cantidad, vendedor) VALUES ('".$rand_token."', ".(int)$secure_cant.", '".$seller."')";
    if($conn->query($quer) != TRUE) echo "algo salio mal, hablale a joaco" ;

    echo "<div class='downloads'>";
    echo "<a id='link-btn' class='clipboard qrs' style='justify-content: center'>Copiar link (".$secure_cant.")</a>";
    echo "<p id='link' >https://biosproducciones.jva.com.ar/verification/ticket.php?token=".$rand_token."</p>";
    echo "</div>";
    
    //cleanDir('qr/');
    //system('python3  app/creador.py '.$nombre.' '.$seller);
    //if($handle = opendir('qr/')) {
    //    echo "<div class='downloads'>";
    //    $count = 0;
    //    while (false !== ($entry = readdir($handle))){
    //         if($entry != '.' && $entry != '..') {
    //            echo "<a class='qrs' href='app/download.php?file=".$entry."'>".$entry."</a> \n";
    //            $count++;
    //         }
    //    }
    //    echo "</div>";
    //}
}

?>
