<?php

class DbController
{
    public $dbHost="localhost";
    public $dbUser="root";
    public $dbPassword="";
    public $dbName="furni";
    public $connection;

    public function openConnection(){
        $this->connection = new mysqli($this->dbHost ,$this->dbUser ,$this->dbPassword ,$this->dbName);
        if($this->connection->connect_error){
            echo "error in connection".$this->connection->connect_error;
            return false;
        }
        else{
            return true;
        }
            
    }

    public function closeConnection(){
        if($this->connection){
            $this->connection->close();
            echo "DONE : connection closed";
        }
        else{
            echo "connection already closed";
        }
    }


    public function select($query){
        $result = $this->connection->query($query);
        if($result===false){
            echo "wrong in query".mysqli_error($this->connection);
            return false;
        }
        else{
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert ($qry){
        $result = $this->connection->query($qry);
        if( !$result )
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            //what session you will add ?
            return false;
        }
        return $this->connection->insert_id; //if you need id that last insert
    }

    public function update ($qry)
    {
        $result = $this->connection->query($qry);
        if( $result )
            return true;
        else
            return false;
    }
    
    public function delete($qry)
    {
        $result = $this->connection->query($qry);
        if( $result )
            return true;
        else
            return false;
    }
}


?>
