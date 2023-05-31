<?php
header("Access-control-cross-origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../models/Product.php";

$db = new DbConnect();

$conn = $db->connect();

$product = new Product($conn);

$products = file_get_contents('data/product.json');
$json_product = json_decode($products, true);

//Creating dummy products
foreach($json_product['data'] as $prd){
    try{
        $res = $product->createProduct($prd['name'], $prd['price'], $prd['category_id']);
        $response['status'] = 'Success';
        $response['message'] = 'Product added';

        echo $response;
    }catch(Exception $e){
        $response['status'] = 'Failed';
        $response['message'] = $e->getMessage();

        print_r($response) ;
    }
    
} 
