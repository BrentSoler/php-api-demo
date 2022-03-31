<?php
    class Post{
        public function __construct()
        {  
            $this->run();
        }

        public function run(){
            header('Access-Control-Allow-Origins: *');
            header('Content-Type: application/x-www-form-urlencoded');
            header('Access-Control-Allow-Methods: POST,');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

            include_once './config/Database.php';
            include_once './models/Forms.php';

            $database = new Database();
            $db = $database->connect();

            $forms = new Forms($db);

            $data = json_decode(file_get_contents('php://input'));

            $forms->name = $data->name;
            $forms->email = $data->email;
            $forms->message = $data->message;

            if ($forms->create()){
                echo json_encode(array(
                    'message' => 'SUCCESS'
                ));
            }else{
                echo json_encode(array(
                    'message' => 'FAILED'
                ));
            }
        }
    }
    
