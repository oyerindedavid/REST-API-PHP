<?php
declare(strict_types = 1);

class Product{

    public function __construct(public $con)
    {
        $this->con = $con;
    }
    
    public function getAllProduct() : array{
        $sql = "SELECT * FROM products";
        $query = mysqli_query($this->con, $sql);

        $result = [];
        while($row = mysqli_fetch_array($query)){
           extract($row);
           $res = [
                    "id" => $id,
                    "name"=> $name,
                    "price" => $price,
                    "category_id" => $category_id
                ];
           array_push($result, $res);
        }
        
        return $result;
    }

    public function getAProductById($product_id) : array{
        $sql = "SELECT * FROM products WHERE id = '$product_id' ";
        $query = mysqli_query($this->con, $sql);

        $row = mysqli_fetch_array($query);
        if($row){
            extract($row);
            $res = [
                    "id" => $id,
                    "name"=> $name,
                    "price" => $price,
                    "category_id" => $category_id
                ];
        }else{
            $res = ["status" => "No record", "message"=>"Product does not exist"];
        }
        return $res;
    }

    public function createProduct($name, $price, $category_id): bool{
        $product_id = uniqid() . $category_id;

        $sql = "INSERT INTO products (id, name, price, category_id) VALUES ('$product_id', '$name', '$price', $category_id)";
        $query = mysqli_query($this->con, $sql);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function updateProduct($product_id, $name, $price, $category_id): bool{
        $sql = "UPDATE products SET name='$name', price= '$price', category_id=$category_id WHERE id= '$product_id' ";
        $query = mysqli_query($this->con, $sql);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function delete($product_id): bool{
        $sql = "DELETE FROM products WHERE id= '$product_id' ";
        $query = mysqli_query($this->con, $sql);

        if($query){
            return true;
        }else{
            return false;
        }
    }
}