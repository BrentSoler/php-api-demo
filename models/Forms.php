<?php
    class Forms{
        private $conn;
        private $table = 'requests';

        public $id;
        public $name;
        public $email;
        public $message;
        public $date_posted;
        public $approved;

        public function __construct($db){
            $this->conn=$db;
        }

        public function create(){
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    name = :name,
                    email = :email,
                    message = :message';

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->message = htmlspecialchars(strip_tags($this->message));
           
            $stmt->bindParam('name',$this->name);
            $stmt->bindParam('email',$this->email);
            $stmt->bindParam('message',$this->message);
            
            if ($stmt->execute()){
                return true;
            }

            printf("ERROR: %s \n" . $stmt->error);

            return false;

        }

        public function getAllData(){
            $query = 'SELECT
                r.id,
                r.name,
                r.email,
                r.message,
                r.date_posted,
                r.approved 
            FROM ' . $this->table . ' r
            ORDER BY 
                r.date_posted DESC';
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function update(){
            $query = 'UPDATE ' . $this->table .' 
                SET 
                    name = :name,
                    email = :email,
                    approved = :approved,
                    message = :message 
                WHERE
                    id = :id';

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->message = htmlspecialchars(strip_tags($this->message));
            $this->approved = htmlspecialchars(strip_tags($this->approved));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':name',$this->name);
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':message',$this->message);
            $stmt->bindParam(':approved',$this->approved);

            if($stmt->execute()){
                return true;
            }

            printf("ERROR: %s \n" . $stmt->error);

            return false;
        }

        public function readSingle(){
            $query = 'SELECT
                r.id,
                r.name,
                r.email,
                r.message,
                r.date_posted,
                r.approved
            FROM ' . $this->table .' r  
            WHERE
                id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id',$this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->message = $row['message'];
            $this->date_posted = $row['date_posted'];
            $this->approved = $row['approved'];

            return $stmt;

        }
    }