<?php
    class Database{
        private $host = 'mysql8001.site4now.net';
        private $dbName = 'db_a84ee5_reqapi';
        private $username ='a84ee5_reqapi';
        private $password = 'testing123';
        private $conn;

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $err){
                echo "ERROR: " . $err->getMessage(); 
            }

            return $this->conn;

        }
    }