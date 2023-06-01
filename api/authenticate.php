<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/Database.php";
require_once "../config/config.php";
require_once "../models/Product.php";
require_once "../helper/helper.php";

use Firebase\JWT\JWT;

//Authenticate user and provide access token
if(isValidLoginCredention()){
    $secrete_key = "mysecretekey";
    $issued_at = new DateTimeImmutable();
    $expire = $issued_at->modify('+10 minutes')->getTimestamp();  //Add 10 minutes
    $server_name = "localhost"; //Domain name e.g www.domain.com
    $username = "username";  //Optional

    $data = [
     'iat' => $issued_at->getTimestamp(), // Issued at: time when the token was generated
     'iss' => $server_name,               // Issuer
     'nbf' => $issued_at->getTimestamp(), // Not before
     'exp' => $expire,                    // Expire
     'username' => $username
    ];

    echo JWT::encode($data, $secrete_key, 'HS512');
 }else{
    echo ["status"=>401, "Invalid login credentials provided"];
 }

