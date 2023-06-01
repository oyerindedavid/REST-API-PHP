<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../config/config.php";
require_once "../../models/Product.php";
require_once "../../helper/helper.php";
require_once "../validate.php";

$db = new DbConnect();

$conn = $db->connect();

$product = new Product($conn);

$data = json_decode(file_get_contents("php://input"));

$name = cleanData($conn, $data->name);
$price = cleanData($conn, $data->price);
$category_id = cleanData($conn, $data->category_id);

try{
    $res = $product->createProduct(
                name: $name, 
                price: $price, 
                category_id: $category_id
            );

    $response['status'] = 'Success';
    $response['message'] = 'Product added';

    echo json_encode($response);
}catch(Exception $e){
    $response['status'] = 'Failed';
    $response['message'] = $e->getMessage();

    echo json_encode($response);
}
