<?php
    class MgrHistory{

        // Connection
        private $conn;

        // Table
        private $db_table = "mgr_history";

        // Columns
        public $emp_num;
        public $dept_id;
        public $date_assign;
        public $employee_emp_num;

        public $join_dept_id;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //CREATE 
        public function createMgrHistory(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        emp_num         = :emp_num, 
                        dept_id         = :dept_id, 
                        date_assign     = :date_assign,
                        employee_emp_num  = :employee_emp_num";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->emp_num          = htmlspecialchars(strip_tags($this->emp_num));
            $this->dept_id          = htmlspecialchars(strip_tags($this->dept_id));
            $this->date_assign      = htmlspecialchars(strip_tags($this->date_assign));
            $this->employee_emp_num = htmlspecialchars(strip_tags($this->employee_emp_num));
           
            // bind data
            $stmt->bindParam(":emp_num", $this->emp_num);
            $stmt->bindParam(":dept_id", $this->dept_id);
            $stmt->bindParam(":date_assign", $this->date_assign);
            $stmt->bindParam(":employee_emp_num", $this->employee_emp_num);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getMgrHistory(){
            $query = "SELECT e.first_name, e.last_name, d.dept_name, t.date_assign FROM ". $this->db_table ." t
            left join employee e on e.emp_num = t.emp_num 
            left join department d on d.dept_id = t.dept_id
            WHERE t.dept_id = ".$this->join_dept_id;

            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>