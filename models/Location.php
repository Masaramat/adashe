<?php

    class Location{
        //DB stuff
        private $conn;
        private $table = "locations";
        private $view = "locations_view";

        //application properties
        public $location_id;
        public $location_name;
        public $user_name;
        public $branch_name;

        public $user_id;
        public $branch_id;


        //constructor
        public function __construct($db){
            $this->conn = $db;
        
        }
       
        // get loan applications
        public function read(){
            //get query
            $query = "SELECT 
                location_id,
                location_name,                               
                branch_name,
                name
            FROM 
                ". $this->view ." 
            ORDER BY location_id ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single branch
        public function read_single(){
             //get query
             $query = "SELECT 
                location_id,
                location_name,                               
                branch_name,
                name
         FROM 
             ". $this->view ." 

            WHERE location_id = :id
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':id', $this->location_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            
            $this->location_id = $row['location_id'];
            $this->location_name = $row['location_name'];
            $this->branch_name = $row['branch_name'];
            $this->user_name = $row['name'];
            
            
        }

        //create branch
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                location_name = :location_name,
                user_id = :user_id,
                branch_id = :branch_id"
                
                ;

            $stmt = $this->conn->prepare($query);

            $this->location_name = htmlspecialchars(strip_tags($this->location_name));
            $this->branch_id = htmlspecialchars(strip_tags($this->branch_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            //bind data
            $stmt->bindParam(':location_name', $this->location_name);
            $stmt->bindParam(':branch_id', $this->branch_id);
            $stmt->bindParam(':user_id', $this->user_id);
            
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
                    location_name = :location_name,
                    user_id = :user_id,
                    branch_id = :branch_id                    
                WHERE 
                    location_id = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            
            $this->location_name = htmlspecialchars(strip_tags($this->location_name));
            $this->branch_id = htmlspecialchars(strip_tags($this->branch_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->location_id = htmlspecialchars(strip_tags($this->location_id));

            //bind data
            $stmt->bindParam(':location_name', $this->location_name);
            $stmt->bindParam(':branch_id', $this->branch_id);
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':id', $this->location_id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 

         //delete Branch
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE location_id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->location_id = htmlspecialchars(strip_tags($this->location_id));

            //bind parameter
            $stmt->bindParam(':id', $this->location_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 


    }
    