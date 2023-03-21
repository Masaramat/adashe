<?php
class Database{
    //db parameters
    private $host = "localhost:3306";
    private $databse = "adashe";
    private $user = "root";
    private $password = "SudoP@ssw0rd";
    private $conn;

    //DB Connection
    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host. ';dbname='.$this->databse, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            echo "connection Error: ". $e->getMessage();

        }

        return $this->conn;
    }


}

