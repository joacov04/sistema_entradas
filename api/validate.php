<?php
declare(strict_types=1);
include_once '../app/credentials.inc';
require_once('../JwtHandler.php');

require_once('../vendor/autoload.php');

$authHeader = getallheaders()['Authorization'] ?? null;
$match = str_replace("Bearer ", "", $authHeader);
$jwt = $match;
if (! $jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$jwtObj = New JwtHandler($secretJwt, $serverName);
$data = $jwtObj->decode($jwt);
if($data) {
    //print_r($data);
} else {
    echo "Usuario no logeado";
    header('HTTP/1.0 401 Unauthorized');

}

