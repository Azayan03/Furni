<?php

    require_once "../../Models/user.php";
    require_once "../../Controllers/dbController.php";
class CartController
{
    protected $db;

    public function addToCart($userId,$productId,$productName, $productPhoto ,$productQuantity , $productPrice){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "INSERT INTO cart VALUES('',$userId, $productId , '$productName' , '$productPhoto' , $productQuantity , $productPrice)";
        $this->db->insert($query);
        }
        else{
            echo "error in connection";
        }
    }

    public function getCardProducts($id){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "SELECT * FROM cart where cart_id=$id";
            return $this->db->select($query);
        }
        else{
            echo "error in connection";
        }
    }


    public function deleteFromCart($userId,$productId){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "DELETE FROM cart WHERE cart_id=$userId AND product_id=$productId";
            return $this->db->delete($query);
        }
        else{
            echo "error in connection";
        }
    }

    public function checkInCard($userId,$productId){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "SELECT * FROM cart where cart_id=$userId and product_id=$productId";
            return $this->db->select($query);
        }
        else{
            echo "error in connection";
        }
    }

    public function updateInCart($userId, $productId,$quantity){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "UPDATE cart
            SET quantity=quantity+$quantity
            WHERE cart_id = $userId and product_id=$productId" ;
            $this->db->update($query);
        }
    }

}

?>