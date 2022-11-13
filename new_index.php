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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Generar entradas</title>
</head>
<body>
    
    <script type="text/javascript" src="src/main.js"></script>

    <div>
        <h1>FIESTAS</h1>
        <div id="div_icons">
            <span class="material-symbols-outlined icons" id="add">add</span>
            <span class="material-symbols-outlined icons" id="qr_icon">sync</span>
        </div>

        <div class="flex">
            <a class="p_name">FIESTA DEL POLI</a>
            <?php
            include_once "app/Boliche.php";
            include_once "app/credentials.inc";
            $app = new Boliche($user, $pass, $base, $host);
            $parties = $app->getAllParties();

            foreach ($parties as $party) {
                $showing_name = str_replace('_', ' ', $party[0]);
                echo "<a href='index.php?party=".$party[0]."'>".$showing_name."</a>";
            }

            ?>

        </div>

    </div>
</body>
</html>
