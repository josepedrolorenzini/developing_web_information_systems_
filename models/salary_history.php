<?php
    class SalaryHistory{

        // Connection
        private $conn;

        // Table
        private $db_table = "salary_history";

        // Columns
        public $emp_num;
        public $salary_start_date;
        public $salary_amt;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //CREATE 
        public function createSalaryHistory(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        emp_num             = :emp_num, 
                        salary_start_date   = :salary_start_date, 
                        salary_amt          = :salary_amt";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->emp_num              = htmlspecialchars(strip_tags($this->emp_num));
            $this->salary_start_date    = htmlspecialchars(strip_tags($this->salary_start_date));
            $this->salary_amt           = htmlspecialchars(strip_tags($this->salary_amt));
           
            // bind data
            $stmt->bindParam(":emp_num", $this->emp_num);
            $stmt->bindParam(":salary_start_date", $this->salary_start_date);
            $stmt->bindParam(":salary_amt", $this->salary_amt);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>