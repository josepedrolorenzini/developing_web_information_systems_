<?php
    class Employee{

        // Connection
        private $conn;

        // Table
        private $db_table = "employee";

        // Columns
        public $emp_num;
        public $first_name;
        public $last_name;
        public $birth_date;
        public $sex;
        public $date_assign;
        public $dept_name;
        public $job_desc;
        public $emp_salary;

        public $job_code;
        public $dept_id;
        public $department_dept_id;


        public $name_search;
        public $job_search;
        public $department_search;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEmployees(){
            $query = "SELECT t.*,tj.job_desc, td.dept_name FROM " . $this->db_table . " t
                        LEFT JOIN job tj ON (t.job_code = tj.job_code)
                        LEFT JOIN department td ON (td.dept_id = t.dept_id) ";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        // GET FOR EMP_NUM
        public function getEmployee(){
            $query  = "SELECT t.*, tj.job_desc, td.dept_name FROM ". $this->db_table ." t
                        LEFT JOIN job tj ON (t.job_code = tj.job_code)
                        LEFT JOIN department td ON (td.dept_id = t.dept_id) 
                        WHERE t.emp_num = ? LIMIT 0,1";
            $stmt   = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->emp_num);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->first_name   = $dataRow['first_name'] ?? '';
            $this->last_name    = $dataRow['last_name'] ?? '';
            $this->birth_date   = $dataRow['birth_date'] ?? '';
            $this->sex          = $dataRow['sex'] ?? '';
            $this->date_assign  = $dataRow['date_assign'] ?? '';
            $this->dept_name    = $dataRow['dept_name'] ?? '';
            $this->job_desc     = $dataRow['job_desc'] ?? '';
            $this->emp_salary   = $dataRow['emp_salary'] ?? '';

            $this->job_code     = $dataRow['job_code'] ?? null;
            $this->dept_id      = $dataRow['dept_id'] ?? null;
            
            return $stmt->rowCount();
        }  

        //UPDATE FOR EMP_NUM
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    first_name  = :first_name, 
                    last_name   = :last_name, 
                    sex         = :sex, 
                    dept_id     = :dept_id, 
                    job_code    = :job_code,  
                    emp_salary  = :emp_salary
                    WHERE 
                        emp_num = :emp_num";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->first_name   = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name    = htmlspecialchars(strip_tags($this->last_name));
            $this->sex          = htmlspecialchars(strip_tags($this->sex));
            $this->dept_id      = htmlspecialchars(strip_tags($this->dept_id));
            $this->job_code     = htmlspecialchars(strip_tags($this->job_code));
            $this->emp_salary   = htmlspecialchars(strip_tags($this->emp_salary));
            $this->emp_num      = htmlspecialchars(strip_tags($this->emp_num));
        
            // bind data
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":sex", $this->sex);
            $stmt->bindParam(":dept_id", $this->dept_id);
            $stmt->bindParam(":job_code", $this->job_code);
            $stmt->bindParam(":emp_salary", $this->emp_salary);
            $stmt->bindParam(":emp_num", $this->emp_num);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        //CREATE 
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        first_name  = :first_name, 
                        last_name   = :last_name, 
                        birth_date  = :birth_date, 
                        sex         = :sex, 
                        dept_id     = :dept_id, 
                        job_code    = :job_code,
                        date_assign = :date_assign,
                        department_dept_id    = :department_dept_id,  
                        emp_salary  = :emp_salary";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->first_name   = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name    = htmlspecialchars(strip_tags($this->last_name));
            $this->birth_date   = htmlspecialchars(strip_tags($this->birth_date));
            $this->sex          = htmlspecialchars(strip_tags($this->sex));
            $this->dept_id      = htmlspecialchars(strip_tags($this->dept_id));
            $this->job_code     = htmlspecialchars(strip_tags($this->job_code));
            $this->emp_salary   = htmlspecialchars(strip_tags($this->emp_salary));
            $this->date_assign  = htmlspecialchars(strip_tags($this->date_assign));
            $this->department_dept_id   = htmlspecialchars(strip_tags($this->department_dept_id));
        
            // bind data
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":birth_date", $this->birth_date);
            $stmt->bindParam(":sex", $this->sex);
            $stmt->bindParam(":dept_id", $this->dept_id);
            $stmt->bindParam(":job_code", $this->job_code);
            $stmt->bindParam(":date_assign", $this->date_assign);
            $stmt->bindParam(":department_dept_id", $this->department_dept_id);
            $stmt->bindParam(":emp_salary", $this->emp_salary);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        //SEARCH
        public function searchEmployees(){
            $query = "SELECT t.*,tj.job_desc, td.dept_name FROM " . $this->db_table . " t
                        LEFT JOIN job tj ON (t.job_code = tj.job_code)
                        LEFT JOIN department td ON (td.dept_id = t.dept_id) 
                        WHERE 1";
            if($this->name_search != ''){
                $query .= " AND (t.first_name like '%".$this->name_search ."%' 
                            OR t.last_name like '%".$this->name_search ."%') ";
            }
            if($this->job_search != ''){
                $query .= " AND tj.job_desc = '".$this->job_search."' ";
            }
            if($this->department_search != ''){
                $query .= " AND t.dept_id IN ('".$this->department_search."') ";
            }
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? array();
            return $res;
        }
    }
?>