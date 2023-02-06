<?php

declare(strict_types=1);

use Firebase\JWT\JWT;

require_once('vendor/autoload.php');
require_once('app/connect.php');

//$secure_token = mysqli_real_escape_string($conn, $_GET['token']);
echo $_POST['mail'];
echo ":";
echo $_POST['pswd'];
echo $_POST['frmLogin'];
$hasValidCredentials = true;

if ($hasValidCredentials) {
    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
    $tokenId    = base64_encode(random_bytes(16));
    $issuedAt   = new DateTimeImmutable();
    //$expire     = $issuedAt->modify('+59 minutes')->getTimestamp();      // Add 60 seconds
    $serverName = "jva";
    $mail   = "joaquin@jva.com.ar";                                           // Retrieved from filtered POST data

    // Create the token as an array
    $data = [
        'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
        'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
        'iss'  => $serverName,                  // Issuer
        'nbf'  => $issuedAt->getTimestamp(),    // Not before
        'data' => [                             // Data related to the signer user
            'mail' => $mail,            // User name
        ]
    ];

    // Encode the array to a JWT string.
    $token = JWT::encode(
        $data,      //Data to be encoded in the JWT
        $secretKey, // The signing key
        'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    );
    header('Authorization: Bearer '.$token);
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    echo $token;
}
