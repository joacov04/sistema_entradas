<?php
include_once '../app/connect.php';
include_once '../app/credentials.inc';
require_once('../vendor/autoload.php');
require_once('../JwtHandler.php');


$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$sql = $conn->query("SELECT * FROM bios_users WHERE mail='".$mail."'");
$result = $sql->fetch_array(MYSQLI_ASSOC);
if($result && $pass == $result['pass']) {
    $jwt = New JwtHandler($secretJwt, $serverName); // imported from credentials.inc
    $data = [
        'name' => $result['nombre'],
        'mail' => $mail,
    ];
    $token = $jwt->encode($data);
    $response = [
        'access_token' => $token,
        'token_type' => 'Bearer',
    ];
    echo json_encode($response);
    header('Authorization: Bearer '.$token);
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

} else {
    $error = [
        'error' => 'Credenciales incorrectas',
    ];
    echo json_encode($error);
}

?>
