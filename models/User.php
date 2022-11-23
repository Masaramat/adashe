<?php

    class User{
        //DB stuff
        private $conn;
        private $table = "users";

        //application properties
        public $user_id; 
        public $user_name;
        public $name;
        public $password;


        //constructor
        public function __construct($db){
            $this->conn = $db;
        
        }
       
        // get loan applications
        public function read(){
            //get query
            $query = "SELECT 
                user_id,
                username,   
                name,
                password
            FROM 
                ". $this->table ." 
            ORDER BY user_id ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single branch
        public function read_single(){
             //get query
             $query = "SELECT 
                user_id,
                username,   
                name,
                password
         FROM 
             ". $this->table ." 

            WHERE user_id = :id
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':id', $this->user_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties            
            $this->user_id = $row['user_id'];
            $this->user_name = $row['username'];
            $this->name = $row['name'];
            $this->password = md5($row['name']);          
            
        }

        //create branch
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                name = :name,
                username = :username,
                password = :password"
                
                ;

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->user_name = htmlspecialchars(strip_tags($this->user_name));
            $this->password = htmlspecialchars(strip_tags($this->password));

            //bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':username', $this->user_name);
            $password = md5($this->password);
            $stmt->bindParam(':password', $password);
            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }  

        //update loan application
        public function update(){
            //create query
            $query = "UPDATE " .
                    $this->table . "
                SET       
                    name = :name,
                    username = :username,
                    password = :password                   
                WHERE 
                    user_id = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->user_name = htmlspecialchars(strip_tags($this->user_name));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':username', $this->user_name);
            $password = md5($this->password);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $this->user_id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 

         //delete Branch
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE user_id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //bind parameter
            $stmt->bindParam(':id', $this->user_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 


    }
    