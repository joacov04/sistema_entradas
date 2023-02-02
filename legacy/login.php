<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
    <link rel="stylesheet" href="verification/ticket.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="src/login.js"></script>
    <title>Iniciar Sesión</title>
</head>
<body>
    <section id="header">
        <h1>BIOS</h1>
    </section>
    
    <section id="login">
        <div>
            <h1>Iniciar Sesión</h1>
            <form action="authenticate.php" method="post" id="frmLogin">
                <input placeholder="Email" name="user" id="user" required>      
                <input placeholder="Contraseña" name="pswd" id="pswd" required>            
                <a href="google.com">Olvidé mi contraseña.</a>
                <button type="submit" id="submit" class="registerbtn"><b>Entrar</b></button>
            </form>
        </div>    
        
        <hr>
    </section>


</body>
