<?php

    class YearPlan{
        //DB stuff
        private $conn;
        // private $table = "yearplan";
        private $view = "yearplan_view";
        private $plan_table = 'yearplan';
        private $member_table = 'members';
        private $member_view = "member_view";

        private $role_table = "group_position";

        //application properties
        public $rcc_id;
        public $rcc_name;
        public $year_plan_id;
        public $startweek;
        public $end_date;
        public $share_value;
        public $welfare;
        public $members;
        public $lcc_name;
        public $group_name;

        public $member_name;
        public $group_id;
        public $contact_address;
        public $phone_no;
        public $email;
        public $role_in_group;
        public $password;

        public $status;


        //constructor
        public function __construct($db){
            $this->conn = $db;

        }

        // get loan applications
        public function read(){
            //get query
            $query = "SELECT *
                FROM
                ". $this->view ."
                 ORDER BY group_name ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            if($stmt){}

            return $stmt;
        }

         public function read_members($year_plan_id){
            //get query
            $query = "SELECT *
                FROM
                ". $this->member_view ."
                WHERE group_id = 
                ".$year_plan_id."
                 ORDER BY member_name ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function read_roles(){
            //get query
            $query = "SELECT * FROM
                ". $this->role_table;

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }



        // //read single branch
        // public function read_single(){
        //      //get query
        //      $query = "SELECT
        //      branch_id,
        //      branch_name
        //  FROM
        //      ". $this->table ."

        //     WHERE branch_id = :id
        //     LIMIT 0,1";

        //     //prepare query
        //     $stmt = $this->conn->prepare($query);

        //     //bind params
        //     $stmt->bindParam(':id', $this->branch_id);

        //     //exceute query
        //     $stmt->execute();

        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //     //set properties

        //     $this->branch_id = $row['branch_id'];
        //     $this->branch_name = $row['branch_name'];


        // }

        //create branch
        public function create(){
            //create query
            $inserted = false;
            $query = "INSERT INTO " .
                    $this->plan_table . "
                SET
                    group_id= :group_id,
                    startweek = :startweek,
                    sharevalue= :share_value,
                    welfarevalue= :welfare, 
                    status = :status ";

            $stmt = $this->conn->prepare($query);

            $this->group_id = htmlspecialchars(strip_tags($this->group_id));
            $this->startweek = htmlspecialchars(strip_tags($this->startweek));
            $this->share_value = htmlspecialchars(strip_tags($this->share_value));
            $this->welfare = htmlspecialchars(strip_tags($this->welfare));
            $this->status = htmlspecialchars(strip_tags($this->status));


            //bind data
            $stmt->bindParam(':group_id', $this->group_id);
            $stmt->bindParam(':startweek', $this->startweek);
            $stmt->bindParam(':share_value', $this->share_value);
            $stmt->bindParam(':welfare', $this->welfare);
            $stmt->bindParam(':status', $this->status);
            if($stmt->execute()){
                $inserted = true;
            }
            $inserted = false;

            $plan_id = $this->conn->lastInsertId();

            $this->members = json_decode(json_encode($this->members), true);

             $query1 = "INSERT INTO " .
                    $this->member_table . "
                SET
                    group_id= :year_plan_id,
                    member_name = :member_name,
                    contact_address= :contact_address,
                    phone_no= :phone_no, 
                    email = :email,
                    role_in_group = :role_in_group,
                    password = :password ";

            $stmt1 = $this->conn->prepare($query1);

            //bind data
            foreach($this->members as $member){
                $stmt1->bindParam(':year_plan_id', $plan_id);
                $stmt1->bindParam(':member_name', $member['member_name']);
                $stmt1->bindParam(':contact_address', $member['contact_address']);
                $stmt1->bindParam(':phone_no', $member['phone_no']);
                $stmt1->bindParam(':email', $member['email']);
                $stmt1->bindParam(':role_in_group', $member['position']);
                $stmt1->bindParam(':password', $member['password']);

                if($stmt1->execute()){
                    $inserted = true;
                }

                
            }
            
            if($inserted){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // //update loan application
        // public function update(){
        //     //create query
        //     $query = "UPDATE " .
        //             $this->table . "
        //         SET
        //             branch_name = :branch_name
        //         WHERE
        //             branch_id = :id";
        //     //prepare statement
        //     $stmt = $this->conn->prepare($query);




        //     //bind data
        //     $stmt->bindParam(':id', $this->branch_id);
        //     $stmt->bindParam(':branch_name', $this->branch_name);

        //     if($stmt->execute()){
        //         return true;
        //     }

        //     printf("Error: %s.\n", $stmt->error);
        //     return false;
        // }

        //  //delete Branch
        // public function delete(){
        //     //delete query
        //     $query = 'DELETE from '.$this->table. ' WHERE branch_id = :branch_id';

        //     //prepare statement
        //     $stmt = $this->conn->prepare($query);

        //     //Clean id
        //     $this->branch_id = htmlspecialchars(strip_tags($this->branch_id));

        //     //bind parameter
        //     $stmt->bindParam(':branch_id', $this->branch_id);


        //     if($stmt->execute()){
        //         return true;
        //     }

        //     printf("Error: %s.\n", $stmt->error);
        //     return false;
        // }


    }
