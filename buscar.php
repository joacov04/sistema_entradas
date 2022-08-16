<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/fdp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>FDP</title>
</head>
<body>

    <div class='flex'>
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
    
</body>
</html>
