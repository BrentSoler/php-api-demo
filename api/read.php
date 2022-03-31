<?php
    class Read{

        public function __construct()
        {
            $this->read();
        }

        public function read(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
        
            include_once './config/Database.php';
            include_once './models/Forms.php';
        
            $database = new Database();
            $db = $database->connect();
        
            $form = new Forms($db);
            $results = $form->getAllData();
        
            $num = $results->rowCount();
        
            if($num>0){
        
                $form_arr = array();
                $form_arr["data"] = array();
        
                while ($row = $results->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
        
                    $request = array(
                        "id" => $id,
                        "name" => $name,
                        "email" => $email,
                        "message" => $message,
                        "date_posted" => $date_posted,
                        "approved" => $approved
                    );
                    
                    array_push($form_arr["data"],$request);
                }
        
                echo json_encode($form_arr);
                
            }else{
                $form_arr = array();
                $form_arr["data"] = array(
                    "message" => "No Request"
                );
        
                echo json_encode($form_arr);
            }
        }  
    }
   

