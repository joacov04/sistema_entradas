<?php
declare(strict_types=1);

use Firebase\JWT\JWT;

require_once('vendor/autoload.php');

$authHeader = getallheaders()['Authorization'] ?? null;
$match = str_replace("Bearer ", "", $authHeader);
if (! $match) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Token not found in request';
    exit;
}
$jwt = $match;
if (! $jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
try {
    $token = JWT::decode($jwt, $secretKey, ['HS512']);

} catch (Exception $e) {
    echo "Error with JWT: ".$e;
}
$now = new DateTimeImmutable();
$serverName = "jva";

if ($token->iss !== $serverName ||
    $token->nbf > $now->getTimestamp())
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}
echo $token->data->mail;
