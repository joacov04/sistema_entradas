<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Generar entradas</title>
</head>
<body>
    
    <script type="text/javascript" src="src/multipleNames.js"></script>

    <div>
        <h1>ENTRADAS</h1>
        <div id="imgs" class="flex">
            <a id="a_camara" href="camera.php"><img src="img/camera.png" id="camera"></a>
            <a id="a_lupa" href="buscar.php"><img src="img/lupa.png" id="lupa"></a>
        </div>

        <form  method="post">                
            <div class="field_wrapper flex">
                <div>
                    <input type="text" placeholder="Nombre y Apellido" name="field_name[]" value="">
                    <a href="javascript:void(0);" class="add_button" title="Add field">+</a>
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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a id="bottom-link" target="_blank" href="https://github.com/joacov04/sistema_entradas"><i class="fa fa-github" style="font-size:24px"></i> Página oficial</a>
</body>
</html>
