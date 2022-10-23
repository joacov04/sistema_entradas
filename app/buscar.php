<!DOCTYPE html>
<?php
$user = $_SERVER['PHP_AUTH_USER'];
if ($user != 'joaquin') {
    header("Location: publicas.php", true, 301);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script type="text/javascript" src="../src/main.js"></script>
    <title>Buscar entrada</title>

</head>
<body>

    <div class='flex'>
        <span class="material-symbols-outlined icons" id="arrow_back" onclick="window.location.href='../'">arrow_back</span>
        
        <div class="box">
            <table id="names">
            <div>
                <h2 class="title">Buscar - Admin Panel</h2>
                <span class="material-symbols-outlined icons" id="sync">sync</span>
            </div>
                <input type="text" id="search_name" onkeyup="nameSearch($('#search_select').val())" placeholder="Buscar">
                <select id="search_select">
                    <option value="0">Nombre</option>
                    <option value="1">Token</option>
                    <option value="3">Vendedor</option>
                    <option value="2">Usada</option>
                </select>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Token</th>
                        <th>Usada</th>
                        <th>Vendedor</th>
                        <th>Marcar como</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include("backend_buscar.php");
                ?>
                </tbody>
            </table>

        </div>

    </div>
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a id="bottom-link" target="_blank" href="https://github.com/joacov04/sistema_entradas"><i class="fa fa-github" style="font-size:24px"></i> Página oficial</a>
    
</body>
</html>
