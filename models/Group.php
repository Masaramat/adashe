<?php
    class Group{
        //DB stuff
        private $conn;
        private $table = "adashe.groups";

        private $view = "groups_view";

        //application properties
        public $group_id;
        public $group_name;
        public $lcc_name;
        public $rcc_id;
        public $rcc_name;
        public $agent_id;
        public $agent_name;

        public $agent_email;

        public function __construct($db){
            $this->conn = $db;
        
        }

        // get loan applications
        public function read(){
            //get query
            $query = "SELECT * FROM 
                ". $this->view ." 
            ORDER BY sno ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single loan application
        public function read_single(){
            //get query
            $query = "SELECT * FROM 
                ". $this->view ." 
            
            WHERE sno = ?
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(1, $this->group_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);

            //set properties
            
            $this->group_id = $sno;
            $this->group_name = $group_name;
            $this->lcc_name = $lcc_name;
            $this->rcc_name = $rcc_name;
            $this->agent_name = $agent_name;
            $this->agent_email = $agent_email;
            
        }

        //create loan application
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                rcc_id = :rcc_id,
                lcc_name = :lcc_name,
                group_name = :group_name";

            $stmt = $this->conn->prepare($query);

            $this->rcc_id = htmlspecialchars(strip_tags($this->rcc_id));
            $this->lcc_name = htmlspecialchars(strip_tags($this->lcc_name));
            $this->group_name = htmlspecialchars(strip_tags($this->group_name));                
           

            //bind data
            $stmt->bindParam(':rcc_id', $this->rcc_id);
            $stmt->bindParam(':lcc_name', $this->lcc_name);
            $stmt->bindParam(':group_name', $this->group_name);
            
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
                    rcc_id = :rcc_id,
                    lcc_name = :lcc_name,
                    group_name = :group_name
                WHERE 
                    sno = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            


            $this->rcc_id = htmlspecialchars(strip_tags($this->rcc_id));
            $this->lcc_name = htmlspecialchars(strip_tags($this->lcc_name));
            $this->group_name = htmlspecialchars(strip_tags($this->group_name));                
           

            //bind data
            $stmt->bindParam(':rcc_id', $this->rcc_id);
            $stmt->bindParam(':lcc_name', $this->lcc_name);
            $stmt->bindParam(':group_name', $this->group_name);
            $stmt->bindParam(':id', $this->group_id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }  
        
        //delete application
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE sno = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->group_id = htmlspecialchars(strip_tags($this->group_id));

            //bind parameter
            $stmt->bindParam(':id', $this->group_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        
        
    }