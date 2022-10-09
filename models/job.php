<?php
    class Job{

        // Connection
        private $conn;

        // Table
        private $db_table = "job";

        // Columns

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getJobs(){
            $query = "SELECT * FROM " . $this->db_table . "";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute();
            $res   = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

    }
?>