<?php
    class JobHistory{

        // Connection
        private $conn;

        // Table
        private $db_table = "job_history";

        // Columns
        public $emp_num;
        public $dept_id;
        public $date_assign;
        public $job_code;
        public $emp_salary;
        public $employee_emp_num;
        public $department_dept_id;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //CREATE 
        public function createJobHistory(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        emp_num         = :emp_num, 
                        dept_id         = :dept_id, 
                        date_assign     = :date_assign,
                        job_code        = :job_code,
                        emp_salary      = :emp_salary,
                        employee_emp_num  = :employee_emp_num, 
                        department_dept_id = :department_dept_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->emp_num          = htmlspecialchars(strip_tags($this->emp_num));
            $this->dept_id          = htmlspecialchars(strip_tags($this->dept_id));
            $this->date_assign      = htmlspecialchars(strip_tags($this->date_assign));
            $this->job_code         = htmlspecialchars(strip_tags($this->job_code));
            $this->emp_salary       = htmlspecialchars(strip_tags($this->emp_salary));
            $this->employee_emp_num = htmlspecialchars(strip_tags($this->employee_emp_num));
            $this->department_dept_id = htmlspecialchars(strip_tags($this->department_dept_id));
           
            // bind data
            $stmt->bindParam(":emp_num", $this->emp_num);
            $stmt->bindParam(":dept_id", $this->dept_id);
            $stmt->bindParam(":date_assign", $this->date_assign);
            $stmt->bindParam(":job_code", $this->job_code);
            $stmt->bindParam(":emp_salary", $this->emp_salary);
            $stmt->bindParam(":employee_emp_num", $this->employee_emp_num);
            $stmt->bindParam(":department_dept_id", $this->department_dept_id);

            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // GET FOR EMP_NUM
        public function getJobHistory(){

            $query  = "SELECT t.*, tj.job_desc, td.dept_name, te.first_name, te.last_name FROM ". $this->db_table ." t
                        LEFT JOIN employee te ON (te.emp_num = t.emp_num)
                        LEFT JOIN job tj ON (t.job_code = tj.job_code)
                        LEFT JOIN department td ON (td.dept_id = t.dept_id) 
                        WHERE t.emp_num = ? ";
            $stmt   = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->emp_num);
            $stmt->execute();

            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }  
    }
?>