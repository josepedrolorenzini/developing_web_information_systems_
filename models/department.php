<?php
    class Department{

        // Connection
        private $conn;

        // Table
        private $db_table = "department";

        // Columns
        public $join_dept_id;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDepartments(){
            $query = "SELECT * FROM " . $this->db_table . "";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? array();
            return $res;
        }

        //GET MANAGER
        public function getDepartmentsWithManager(){
            $query  = "SELECT t.dept_id, e.first_name, e.last_name, t.dept_name , t.emp_num  FROM ".$this->db_table." t
                        LEFT JOIN employee e ON e.emp_num = t.emp_num";
            $stmt   = $this->conn->prepare($query);
            $stmt->execute();
            $res    = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        //GET QUANTITY EMPLOYEE 
        public function getQuantityEmployeeForDeparment(){
            $query  = "SELECT *  FROM ".$this->db_table." t
                        LEFT JOIN employee e ON e.dept_id = t.dept_id
                        WHERE e.dept_id = ".$this->join_dept_id;
            $stmt   = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->join_dept_id);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
?>