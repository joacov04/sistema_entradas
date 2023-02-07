<?php

declare(strict_types=1);

use Firebase\JWT\JWT;

require_once('vendor/autoload.php');

class JwtHandler {
    private $secretKey;
    private $now;
    private $serverName;

    public function __construct($secretKey, $serverName) {
        $this->secretKey = $secretKey;
        $this->now = New DateTimeImmutable(); 
        $this->serverName = $serverName;
    }

    public function encode($data) {
        //el paylod lo armo aca solo le meto la data
        $issuedAt = new DateTimeImmutable();
        $payload = [
            'iat'  => $issuedAt->getTimestamp(),
            'jti'  => base64_encode(random_bytes(16)),
            'iss'  => $this->serverName,
            'nbf'  => $issuedAt->getTimestamp(),
            'data' => $data,
        ];
        return JWT::encode($payload, $this->secretKey, 'HS512');
    }

    public function decode($jwt) {
        try {
            $token = JWT::decode($jwt, $this->secretKey, array('HS512'));
        } catch(Exception $e) {
            return false;
        }
        if ($token->iss !== $this->serverName || $token->nbf > $this->now->getTimestamp()) {
            return false;
        }
        return $token->data;
    }

}
