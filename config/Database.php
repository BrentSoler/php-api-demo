<?php
    class Database{
        private $host = 'localhost';
        private $dbName = 'request_api';
        private $username ='root';
        private $conn;

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName,$this->username);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $err){
                echo "ERROR: " . $err->getMessage(); 
            }

            return $this->conn;

        }
    }