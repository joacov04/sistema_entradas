<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Escanear QR</title>
</head>
<body class="flex">
    <span class="material-symbols-outlined icons" id="arrow_back" onclick="window.location.href='../index.php'">arrow_back</span>
    <h2 id="text">Scan QR</h2>
    <div id="validation" class="modal">
        <span class="material-symbols-outlined">
        close
        </span>
        <h1 id="modal_name"></h1>
        <p id="modal_token"></p>
        <p id="modal_usada"></p>
    </div>

    <video id="preview"></video>
    <p>Seleccionar una de las opciones<p>
    <select name="cameras" id="cameras">
    </select> 
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a id="bottom-link" target="_blank" href="https://github.com/joacov04/sistema_entradas"><i class="fa fa-github" style="font-size:24px"></i> Página oficial</a>
    
    <script type="text/javascript" src="../src/camera.js"></script>
  </body>
</html>