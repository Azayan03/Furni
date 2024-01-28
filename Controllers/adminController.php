<?php

    require_once "../../Models/user.php";
    require_once "../../Controllers/dbController.php";
class AdminController
{
    protected $db;

    public function addProduct($name , $price , $photo){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "INSERT INTO products VALUES('','$name','$price','$photo')";
        $this->db->insert($query);
        }
        else{
            echo "error in connection";
        }
    }

    public function getProducts(){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "SELECT * FROM products";
            return $this->db->select($query);
        }
        else{
            echo "error in connection";
        }
    }

    public function deleteProduct($id){
        $this->db = new DbController();
        if($this->db->openConnection()){
        $query = "DELETE FROM products WHERE id=$id";
            return $this->db->delete($query);
        }
        else{
            echo "error in connection";
        }
    }
}

?>