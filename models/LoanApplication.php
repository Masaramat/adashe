<?php
    class LoanApplication{
        //DB stuff
        private $conn;
        private $table = "loan_applications";

        private $view = "loan_applications_view";

        //application properties
        public $application_id;
        public $application_date;
        public $account_no;
        public $loan_facility;
        public $tenor;
        public $surname;
        public $othernames;

        public $location_id;
        public $sources_of_repayment;
        public $amount_in_words;
        public $purpose;
        public $status;
        public $phone;
        public $bvn;
        public $address;
        public $business;
         public $fullname;
        
       
        

        public function __construct($db){
            $this->conn = $db;
        
        }

        // get loan applications
        public function read(){
            //get query
            $query = "SELECT 
                customer_name,
                application_id,
                account_no,
                loan_facility,
                amount_in_words,
                tenor,
                purpose,
                business,
                address,
                phone_no,
                bvn,
                application_date,
                application_status,
                location_name,
                name,
                branch_name
            FROM 
                ". $this->view ." 
            ORDER BY application_id ASC";

            //prepare query
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //read single loan application
        public function read_single(){
            //get query
            $query = "SELECT 
                customer_name,
                application_id,
                account_no,
                loan_facility,
                tenor,
                application_date
            FROM 
                ". $this->view ." 
            
            WHERE application_id = ?
            LIMIT 0,1";

            //prepare query
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bindParam(1, $this->application_id);

            //exceute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            
            $this->application_date = $row['application_date'];
            $this->tenor = $row['tenor'];
            $this->customer_name = $row['customer_name'];
            $this->account_no = $row['account_no'];
            $this->application_id = $row['application_id'];
            $this->loan_facility = $row['loan_facility'];
            
        }

        //create loan application
        public function create(){
            //create query
            $query = "INSERT INTO " .
                    $this->table . "
                SET 
                surname = :surname,
                othernames = :othernames,
                bvn = :bvn,
                phone_no = :phone,
                address = :address,
                account_no = :account_no,

                tenor = :tenor,
                loan_facility = :loan_facility,
                amount_in_words = :amount_in_words,

                business = :business,
                purpose = :purpose,
                sources_of_repayment = :sources_of_repayment,

                application_date = curdate(),                
                application_status = 'pending',
                location_id = :location_id";

            $stmt = $this->conn->prepare($query);

            $this->surname = htmlspecialchars(strip_tags($this->surname));
            $this->othernames = htmlspecialchars(strip_tags($this->othernames));
            $this->bvn = htmlspecialchars(strip_tags($this->bvn));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->account_no = htmlspecialchars(strip_tags($this->account_no));

            $this->tenor = htmlspecialchars(strip_tags($this->tenor));
            $this->loan_facility = htmlspecialchars(strip_tags($this->loan_facility));
            $this->amount_in_words = htmlspecialchars(strip_tags($this->amount_in_words));
           
            $this->business = htmlspecialchars(strip_tags($this->business));
            $this->purpose = htmlspecialchars(strip_tags($this->purpose));
            $this->sources_of_repayment = htmlspecialchars(strip_tags($this->sources_of_repayment));
            
            $this->location_id = htmlspecialchars(strip_tags($this->location_id));        
           

            //bind data
            $stmt->bindParam(':surname', $this->surname);
            $stmt->bindParam(':othernames', $this->othernames);
            $stmt->bindParam(':bvn', $this->bvn);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':account_no', $this->account_no);   

            $stmt->bindParam(':tenor', $this->tenor);
            $stmt->bindParam(':loan_facility', $this->loan_facility);            
            $stmt->bindParam(':amount_in_words', $this->amount_in_words);
            
            $stmt->bindParam(':business', $this->business);
            $stmt->bindParam(':purpose', $this->purpose);
            $stmt->bindParam(':sources_of_repayment', $this->sources_of_repayment);
            
            $stmt->bindParam(':location_id', $this->location_id);
            
           


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
                    surname = :surname, 
                    othernames = :othernames, 
                    bvn = :bvn,
                    phone_no = :phone,
                    address = :address,
                    account_no = :account_no,

                    tenor = :tenor,                    
                    loan_facility = :loan_facility,
                    amount_in_words = :amount_in_words,

                    business = :business,
                    purpose = :purpose,
                    sources_of_repayment = :sources_of_repayment,

                    application_status = :status,                   
                    location_id = :location_id
                WHERE 
                    application_id = :id";
            //prepare statement
            $stmt = $this->conn->prepare($query);

            


            //bind data
            $stmt->bindParam(':surname', $this->surname);
            $stmt->bindParam(':othernames', $this->othernames);
            $stmt->bindParam(':bvn', $this->bvn);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':account_no', $this->account_no);

            $stmt->bindParam(':tenor', $this->tenor);            
            $stmt->bindParam(':loan_facility', $this->loan_facility);
            $stmt->bindParam(':amount_in_words', $this->amount_in_words);
           
            $stmt->bindParam(':business', $this->business);
            $stmt->bindParam(':purpose', $this->purpose);
            $stmt->bindParam(':sources_of_repayment', $this->sources_of_repayment);

            $stmt->bindParam(':location_id', $this->location_id); 
            $stmt->bindParam(':status', $this->status);
            
            $stmt->bindParam(':id', $this->application_id);

            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }  
        
        //delete application
        public function delete(){
            //delete query
            $query = 'DELETE from '.$this->table. ' WHERE application_id = :application_id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean id
            $this->status = htmlspecialchars(strip_tags($this->application_id));

            //bind parameter
            $stmt->bindParam(':application_id', $this->application_id);

            
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        
        
    }