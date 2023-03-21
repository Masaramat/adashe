<?php

    class Agent{
        //DB stuff
        private $conn;
        private $table = "agents";

        //application properties
        public $agent_id; 
        public $agent_name;
    
        public $password;
        public $email;
    
        public $contact_address;
         public $phone_no;


        //constructor
        public function __construct($db){
            $this->conn = $db;
        
        }
       
        // get loan applications
        public function read(){
            //get query
            $query = "SELECT * FROM 
                ". $this->table ." 
            ORDER BY sno ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single branch
        public function login(){
             //get query
             $query = "SELECT * FROM 
             ". $this->table ." 

            WHERE email = :email AND password = :password
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //exceute query
           if($row['sno']>0){

                
                extract($row);
                //set properties            
                $this->agent_id = $sno;
                $this->agent_name = $agent_name;
                $this->contact_address = $contact_address;
                $this->phone_no = $phone_no;
                $this->email = $email;
                $this->password = $password;
                return true;

           }else{
                return false;
           }

                     
            
        }

        // //create branch
        // public function create(){
        //     //create query
        //     $query = "INSERT INTO " .
        //             $this->table . "
        //         SET 
        //         name = :name,
        //         username = :username,
        //         password = :password"
                
        //         ;

        //     $stmt = $this->conn->prepare($query);

        //     $this->name = htmlspecialchars(strip_tags($this->name));
        //     $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        //     $this->password = htmlspecialchars(strip_tags($this->password));

        //     //bind data
        //     $stmt->bindParam(':name', $this->name);
        //     $stmt->bindParam(':username', $this->user_name);
        //     $password = md5($this->password);
        //     $stmt->bindParam(':password', $password);
            
        //     if($stmt->execute()){
        //         return true;
        //     }

        //     printf("Error: %s.\n", $stmt->error);
        //     return false;
        // }  

        // //update loan application
        // public function update(){
        //     //create query
        //     $query = "UPDATE " .
        //             $this->table . "
        //         SET       
        //             name = :name,
        //             username = :username,
        //             password = :password                   
        //         WHERE 
        //             user_id = :id";
        //     //prepare statement
        //     $stmt = $this->conn->prepare($query);

            
        //     $this->name = htmlspecialchars(strip_tags($this->name));
        //     $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        //     $this->password = htmlspecialchars(strip_tags($this->password));
        //     $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        //     //bind data
        //     $stmt->bindParam(':name', $this->name);
        //     $stmt->bindParam(':username', $this->user_name);
        //     $password = md5($this->password);
        //     $stmt->bindParam(':password', $password);
        //     $stmt->bindParam(':id', $this->user_id);

        //     if($stmt->execute()){
        //         return true;
        //     }

        //     printf("Error: %s.\n", $stmt->error);
        //     return false;
        // } 

        //  //delete Branch
        // public function delete(){
        //     //delete query
        //     $query = 'DELETE from '.$this->table. ' WHERE user_id = :id';

        //     //prepare statement
        //     $stmt = $this->conn->prepare($query);

        //     //Clean id
        //     $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        //     //bind parameter
        //     $stmt->bindParam(':id', $this->user_id);

            
        //     if($stmt->execute()){
        //         return true;
        //     }

        //     printf("Error: %s.\n", $stmt->error);
        //     return false;
        // } 


    }
    