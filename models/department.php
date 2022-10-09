<?php
    class Department{

        // Connection
        private $conn;

        // Table
        private $db_table = "department";

        // Columns

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDepartments(){
            $query = "SELECT * FROM " . $this->db_table . "";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        //get department and manager
         public function getDepartmentandmanager(){
            $query = "SELECT department.dept_id , employee.first_name, employee.last_name ,department.dept_name , department.emp_num  , department.date_assign 
            FROM  $this->db_table LEFT JOIN employee ON department.emp_num = employee.emp_num ";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

    }
?>