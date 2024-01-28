<?php

    require_once "../../Models/user.php";
    require_once "../../Controllers/dbController.php";
class AuthController
{
    protected $db;

    public function login(User $user){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "select * from users where email = '{$user->getEmail()}' and password = '{$user->getPassword()}'";
            $result = $this->db->select($query);
            if(count($result)==0){
                return false;
            }
            else{
                session_start();
                $user->setFirstName($result[0]["firstName"]);
                $user->setLastName($result[0]["lastName"]);
                $user->setPhoneNumber($result[0]["phoneNumber"]);
                $user->setRole($result[0]["role"]);
                $user->setEmail($result[0]["email"]);
                $user->setPhoto($result[0]["photo"]);
                $_SESSION["userId"]=$result[0]["id"];
                $_SESSION["userEmail"]=$result[0]["email"];
                $_SESSION["userRole"]=$result[0]["role"];
                $_SESSION["userFirstName"]=$result[0]["firstName"];
                $_SESSION["userLastName"]=$result[0]["lastName"];
                $_SESSION["userPhoneNumber"]=$result[0]["phoneNumber"];
                $_SESSION["userPhoto"]=$result[0]["photo"];
                $_SESSION["premium"]=$result[0]["premium"];
                return true;
            }
        }
    }

    public function signUp(User $user){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "select email from users where email = '{$user->getEmail()}'";
            $result = $this->db->select($query);
            if(count($result)==0){
                $query = "INSERT INTO users VALUES('','{$user->getEmail()}','{$user->getFirstName()}','{$user->getLastName()}','','{$user->getPassword()}','','user')";
                $this->db->insert($query);
                return true;
            }
            else{
                return false;
            }
            
        }
    }
    
    public function deleteUser($id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "DELETE FROM users where id = $id";
            $this->db->delete($query);
        }
    }

    public function updateDetails(User $user,$id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "UPDATE users
            SET firstName = '{$user->getFirstName()}', lastName = '{$user->getLastName()}', phoneNumber = '{$user->getPhoneNumber()}'
            WHERE id = $id";
            $this->db->update($query);
        }
    }

    public function checkPassword($password,$id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "SELECT password From users WHERE id = $id and password='$password'";
            $result = $this->db->select($query);
            if(count($result)==0)
                return false;
            return true;
        }
    }


    public function changePassword($password,$id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "UPDATE users SET password = '$password'WHERE id = $id";
            $this->db->update($query);
        }
    }

    public function uploadPhoto($photo,$id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "UPDATE users SET photo = '$photo'WHERE id = $id";
            $this->db->update($query);
        }
    }

    public function removePhoto($id){
        $this->db = new DbController();
        if($this->db->openConnection()){
            $query = "UPDATE users set photo='' where id = $id";
            $this->db->update($query);
        }
    }
}

?>