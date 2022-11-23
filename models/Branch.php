<?php

    class Branch{
        //DB stuff
        private $conn;
        private $table = "branches";

        //application properties
        public $branch_id;
        public $branch_name;

        //constructor
        public function __construct($db){
            $this->conn = $db;
        
        }
       
        // get loan applications
        public function read(){
            //get query
            $query = "SELECT 
                branch_id,               
                branch_name
            FROM 
                ". $this->table ." 
            ORDER BY branch_id ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single branch
        public function read_single(){
             //get query
             $query = "SELECT 
             branch_id,               
             branch_name
         FROM 
             ". $this->table ." 

            WHERE branch_id = :id
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':id', $this->branch_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            
            $this->branch_id = $row['branch_id'];
            $this->branch_name = $row['branch_name'];
            
            
        }

        //create branch
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                branch_name = :branch_name";

            $stmt = $this->conn->prepare($query);

            $this->branch_name = htmlspecialchars(strip_tags($this->branch_name));

            //bind data
            $stmt->bindParam(':branch_name', $this->branch_name);
            
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
                    branch_name = :branch_name                    
                WHERE 
                    branch_id = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            


            //bind data
            $stmt->bindParam(':id', $this->branch_id);
            $stmt->bindParam(':branch_name', $this->branch_name);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 

         //delete Branch
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE branch_id = :branch_id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->branch_id = htmlspecialchars(strip_tags($this->branch_id));

            //bind parameter
            $stmt->bindParam(':branch_id', $this->branch_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 


    }
    