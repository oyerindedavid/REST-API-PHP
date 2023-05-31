<?php
declare(strict_types = 1);

header("Access-Control-Cross-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");

require_once "../../config/Database.php";
require_once "../../config/config.php";
require_once "../../models/Product.php";

if(!isset($_SERVER['PHP_AUTH_USER'])){
    header('WWW-Authenticate: Basic realm="Private Area" ');
    header ("HTTP/1.0 401 Unauthorized");

    $result = ["status" => 401, "message"=>"You need to provide an authentication for access."];
    echo json_encode($result);
    exit;

}else{
    if(($_SERVER['PHP_AUTH_USER'] == $_ENV['API_BASIC_AUTH_USER'] && ($_SERVER['PHP_AUTH_PW'] == $_ENV['API_BASIC_AUTH_PASS'] ))){
        
        $db = new DbConnect();
        $conn = $db->connect();

        $product = new Product($conn);

        $prod = json_decode(file_get_contents("php://input"));

        try{
            $res = $product->delete($prod->id);

            $response['status'] = 'Success';
            $response['message'] = 'Product deleted successfully';

            echo json_encode($response);
        }catch(Exception $e){
            $response['status'] = 'Failed';
            $response['message'] = $e->getMessage();

            echo json_encode($response);
        }

    }else{
        header('WWW-Authenticate: Basic realm="Private Area" ');
        header ("HTTP/1.0 401 Unauthorized");
        $result = ["status" => 401, "message"=>"Invalid authentication credentials"];
        echo json_encode($result);
    }
}



