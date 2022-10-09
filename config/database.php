<?php

class Database
{
    private $hostname = "localhost";
    private $database = "amaz";
    private $username = "root";
    private $password = "";
    private $charset  = "utf8";

    function getConnection()
    {
        try {

            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            return $pdo;
        } 
        catch (PDOException $e) {
            echo 'Error connection: ' . $e->getMessage();
            exit;
        }
    }
}