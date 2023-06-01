<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type,      Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../config/config.php";
require_once "../../models/Product.php";

use Firebase\JWT\JWT;

echo json_encode( $_SERVER);

if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Token not found in request';
    exit;
}

$jwt = $matches[1];
if (! $jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$secretKey  = "mysecretekey";
$token = JWT::decode($jwt, $secretKey, ['HS512']);
$now = new DateTimeImmutable();
$serverName = "your.domain.name";

if ($token->iss !== $serverName ||
    $token->nbf > $now->getTimestamp() ||
    $token->exp < $now->getTimestamp())
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

$db = new DbConnect();
$conn = $db->connect();

$product = new Product($conn);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $product->getAProductById($id);
}else{
    $result = $product->getAllProduct();
}

echo json_encode($result);


