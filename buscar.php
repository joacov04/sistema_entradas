<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Buscar entrada</title>
</head>
<body>

    <div class='flex'>
        <span class="material-symbols-outlined icons" id="arrow_back" onclick="history.back()">arrow_back</span>
        <h1>Buscar nombre</h1>
        <form  method="post">                
            <div class="field_wrapper flex">
                <div>
                    <input type="text" placeholder="Nombre y Apellido" name="nombre" value="">
                </div>
            </div>
            <div class="flex">
                <input type="submit" name="submit" value="BUSCAR">
            </div>
        </form>
        <?php
            include("app/backend_buscar.php");
        ?>

    </div>
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a id="bottom-link" target="_blank" href="https://github.com/joacov04/sistema_entradas"><i class="fa fa-github" style="font-size:24px"></i> Página oficial</a>
    
</body>
</html>
