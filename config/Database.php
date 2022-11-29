<?php
class Database{
    //db parameters
    private $host = "209.205.208.10";
    private $databse = "lightmfb_loans_db";
    private $user = "lightmfb_admin";
    private $password = "Feel@h0me";
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

