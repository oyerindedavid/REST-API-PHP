<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

//Check if client provide authorization
if(!isset($_SERVER['HTTP_AUTHORIZATION'])){
    echo json_encode(["status" => "Failed authorization", "message"=>"You need authorization for access."]);
    exit;
}

//Check if token is found
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(["status" => "Failed authorization", "message"=>"Token not found in request."]);
    exit;
}

$jwt = $matches[1];
if (!$jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(["status" => "Failed authorization", "message"=>"Token not found in request."]);
    exit;
}

try{
    $secretKey  = "mysecretekey";
    $token = JWT::decode($jwt, new Key($secretKey, 'HS512'));
    $now = new DateTimeImmutable();
    $serverName = "localhost";
    
    //Confirm validity of token
    if ($token->iss !== $serverName ||
        $token->nbf > $now->getTimestamp() ||
        $token->exp < $now->getTimestamp())
    {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(["status" => "Failed authorization", "message"=>"Invalid authorization credentials"]);
        exit;
    }
    
}catch(Exception $e){
    echo json_encode(["status" => "Failed authorization", "message"=>$e->getMessage()]) ;
    exit;
}