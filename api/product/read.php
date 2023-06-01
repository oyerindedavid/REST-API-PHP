<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type,      Accept");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../config/config.php";
require_once "../../models/Product.php";
require_once "../validate.php";


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


