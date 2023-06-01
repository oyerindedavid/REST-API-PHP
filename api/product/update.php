<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../config/config.php";
require_once "../../models/Product.php";
require_once "../../helper/helper.php";
require_once "../validate.php";

$db = new DbConnect();

$conn = $db->connect();

//Instantiate product class
$product = new Product($conn);

$prod = json_decode(file_get_contents("php://input"));

$product_id = cleanData($conn, $prod->id);;
$name = cleanData($conn, $prod->name);
$price = cleanData($conn, $prod->price);
$category_id = cleanData($conn, $prod->category_id);

try{
    $res = $product->updateProduct(
                        product_id: $product_id,
                        name: $name, 
                        price: $price, 
                        category_id: $category_id
                    );
    
    $response['status'] =  "Success";
    $response['message'] = 'Product updated successfully';

    echo json_encode($response);
}catch(Exception $e){
    $response['status'] = 'Failed';
    $response['message'] = $e->getMessage();

    echo json_encode($response);
}
