<?php
include "app/credentials.inc";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="src/index.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title><?php echo $table; ?> - Entradas</title>
</head>
<body>
    
    <script type="text/javascript" src="src/main.js"></script>

    <div>
        <h1>BIOS</h1>
        <div id="div_icons">
            <span class="material-symbols-outlined icons" id="search_icon">search</span>
            <span class="material-symbols-outlined icons" id="qr_icon">qr_code_scanner</span>
        </div>

        <form  method="post">                
            <div class="field_wrapper flex">
                <div>
                    <input id="cant" type="number" placeholder="Cantidad" name="cant" value="" min=1 max=100>
                </div>
            </div>
            <div class="flex">
                <input type="submit" name="submit" value="GENERAR">
            </div>
        </form>

    </div>
        <?php
            include("app/submit.php");
        ?>
</body>
</html>
