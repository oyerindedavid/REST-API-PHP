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
    $expire = $issued_at->modify('+10 minutes')->getTimestamp();
    $server_name = "localhost"; //Your domain name e.g www.domain.com
    $username = "username";  //Optional

    $data = [
     'iat' => $issued_at->getTimestamp(),
     'iss' => $server_name, 
     'nbf' => $issued_at->getTimestamp(),
     'exp' => $expire,
     'username' => $username
    ];

    echo JWT::encode($data, $secrete_key, 'HS512');
 }else{
    echo ["status"=>401, "Invalid login credentials provided"];
 }

