<?php
declare(strict_types=1);
include_once 'app/credentials.inc';
require_once('JwtHandler.php');

require_once('vendor/autoload.php');

$authHeader = getallheaders()['Authorization'] ?? null;
$match = str_replace("Bearer ", "", $authHeader);
$jwtCookie = $_COOKIE['token'];
$jwt = $match;
if (!$jwt) {
    $jwt = $jwtCookie;
}

$jwtObj = New JwtHandler($secretJwt, $serverName);
$data = $jwtObj->decode($jwt);

if(!$data) {
    echo "no logeado";
    header('Location: login.php'); // user is not logged in;
    exit;
} 
