<?php

    class RCC{
        //DB stuff
        private $conn;
        private $table = "rccs";
        private $view = "rccs_view";

        //application properties
        public $rcc_id;
        public $rcc_name;
        public $rcc_location;
        public $agent_id;

        public $agent_name;
        public $agent_email;


        //constructor
        public function __construct($db){
            $this->conn = $db;
        
        }
       
        // get loan applications
        public function read(){
            //get query
            $query = "SELECT 
                *
            FROM 
                ". $this->view ." 
            ORDER BY rcc_name ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single branch
        public function read_single(){
             //get query
             $query = "SELECT 
                *
         FROM 
             ". $this->view ." 

            WHERE sno = :id
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':id', $this->rcc_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);           

            if($row){
                //set properties
                extract($row);
                $this->rcc_id = $sno;
                $this->rcc_name = $rcc_name;
                $this->rcc_location = $rcc_location;
                $this->agent_name = $agent_name;
                $this->agent_email = $agent_email;
                $this->agent_id = $agent_id;
                return true;

            }else{
                return false;
            }
            
            
        }

        //create branch
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                rcc_name = :rcc_name,
                rcc_location = :rcc_location,
                agent_id = :agent_id"
                
                ;

            $stmt = $this->conn->prepare($query);

            $this->rcc_name = htmlspecialchars(strip_tags($this->rcc_name));
            $this->rcc_location = htmlspecialchars(strip_tags($this->rcc_location));
            $this->agent_id = htmlspecialchars(strip_tags($this->agent_id));

            //bind data
            $stmt->bindParam(':rcc_name', $this->rcc_name);
            $stmt->bindParam(':rcc_location', $this->rcc_location);
            $stmt->bindParam(':agent_id', $this->agent_id);
            
            if($stmt->execute()){
                $this->rcc_id = $this->conn->lastInsertId();
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
                    rcc_name = :rcc_name,
                    rcc_location = :rcc_location,
                    agent_id = :agent_id                    
                WHERE 
                    sno = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            
            $this->rcc_name = htmlspecialchars(strip_tags($this->rcc_name));
            $this->rcc_location = htmlspecialchars(strip_tags($this->rcc_location));
            $this->agent_id = htmlspecialchars(strip_tags($this->agent_id));
            $this->rcc_id = htmlspecialchars(strip_tags($this->rcc_id));

            //bind data
            $stmt->bindParam(':rcc_name', $this->rcc_name);
            $stmt->bindParam(':rcc_location', $this->rcc_location);
            $stmt->bindParam(':agent_id', $this->agent_id);
            $stmt->bindParam(':id', $this->rcc_id);

            if($stmt->execute()){
                return true;
            }
            return false;
        } 

         //delete Rcc
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE sno = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->rcc_id = htmlspecialchars(strip_tags($this->rcc_id));

            //bind parameter
            $stmt->bindParam(':id', $this->rcc_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        } 


    }
    