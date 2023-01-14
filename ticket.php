<?php
include_once "app/connect.php";


if( 1!=1 && (!isset($_GET['token']))) {
    echo "Sorry. Something went wrong.";
} else {

$secure_token = mysqli_real_escape_string($conn, $_GET['token']);
$quer = "SELECT * FROM bios_tokens WHERE token='".$secure_token."'";
$sql = $conn->query($quer);
$row_cnt = $sql->num_rows;
if ($row_cnt > 0) {
    $row = $sql->fetch_array(MYSQLI_ASSOC);
    $cantidad = $row['cantidad'];
    $usado = $row['datos_cargados'];

    $query2 = "SELECT * FROM bios_persons WHERE token='".$secure_token."'";
    $sql2 = $conn->query($query2);
    $row_cnt2 = $sql2->num_rows;
    if ($row_cnt2 > 0) {
        while($row2 = $sql2->fetch_array(MYSQLI_ASSOC)) {
            $nombre[] = $row2['nombre'];
            $email[] = $row2['mail'];
            $tel[] = $row2['tel'];
            $qr_token[] = $row2['qr_token'];
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
    <link rel="stylesheet" href="style/ticket.css">
    <title>BIOS - ENTRADA</title>
</head>
<body>
    <section id="header">
        <h1>BIOS</h1>
        <h2>REENCUENTRO DE LA COSTA</h2>
        <div>
            <h3>
                SAB 28
                <span style="font-family: Roboto">/</span>
                1
            </h3>
            <h3>ROSARIO</h3>
            <h3>
                <span style="font-family: Roboto">+</span>
                18
            </h3>
        </div>
    </section>

    <hr id="first-hr">

<?php 
if(!$usado) { ?>
    <section id="forms">
        <h1>Registrar entradas</h1>
        <?php
        $x = 0;
        while($x < $cantidad) {
        ?>
        <form method="post">
        <h2>Entrada <?php echo $x+1;?></h2>
            <input placeholder="Nombre y apellido" name="name[]" id="name" required>      
            <input placeholder="Email" name="email[]" id="email" required>      
            <input placeholder="Teléfono" name="tel[]" id="tel" required>      
        <?php $x++;} ?>
        


        <button type="submit" id="submit" name='submit' class="registerbtn"><b>Enviar</b></button>
        </form>
    </section>
    
    <?php
        function generateRandomString($length = 45) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        if(isset($_POST['submit']) && !$usado) {
            $conn->query("UPDATE bios_tokens SET datos_cargados = 1 WHERE token='".$secure_token."' ");
            $name = $_POST['name'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            print_r($name);
            print_r($tel);

            $y=0;
            while($y < $cantidad) {
                $secure_name = mysqli_real_escape_string($conn, $_POST['name'][$y]);
                $secure_email = mysqli_real_escape_string($conn, $_POST['email'][$y]);
                $secure_tel = mysqli_real_escape_string($conn, $_POST['tel'][$y]);

                $qr_token = generateRandomString();

                $quer = "INSERT INTO bios_persons (token, tel, mail, nombre, qr_token, usada) VALUES ('".$secure_token."', ".(int)$secure_tel.", '".$secure_email."', '".$secure_name."', '".$qr_token."', 0)";
                if($conn->query($quer) != TRUE) echo "Algo salio mal, contactate con nosotros." ;
                $y++;
            }
     header("Refresh:0");   
        }
    ?>

    <hr>
    <?php } ?>

    <!--desde aca tendrias que ocultar-->
    <?php if($usado) { ?>
    <section id="">
        <h1>Entradas</h1>
        <?php $z=0; while($z < $cantidad) { 
        $qr = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$qr_token[$z]."&chld=L|1";
        $z++; 
        ?>
        <div>
            <h4><?php echo $nombre[$z-1];?></h4>
            <img src="<?php echo $qr; ?>"/>
        <br><br><br><br>

        </div>
        <?php } ?>
    </section>

    <hr id="download-hr">

<?php } ?>
    <!--hasta aca-->

    <section id="information">
        <p>
            Evento solo para mayores de 18 años. 
        </p>
        <p>
            Metropolitano Rosario, Ingreso por esquina Echeverria y central argenitno.
        </p>
    </section>
    
</body>
</html>
<?php }  ?>
