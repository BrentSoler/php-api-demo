<?php
    class Update {

        public function __construct()
        {
            $this->run();
        }

        public function run(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/x-www-form-urlencoded');
            header('Access-Control-Allow-Methods: PUT');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

            include_once './config/Database.php';
            include_once './models/Forms.php';

            $database = new Database();
            $db = $database->connect();

            $forms = new Forms($db);

            $data = json_decode(file_get_contents('php://input'));
            
            $forms->message = $data->message;
            $forms->id = $data->id;
            $forms->name = $data->name;
            $forms->email = $data->email;
            $forms->approved = $data->approved;

            if($forms->update()){
                echo json_encode(array(
                    'message' => 'SUCCESSFULLY UPDATED'
                ));
            }else{
                echo json_encode(array(
                    'message' => 'SUCCESSFULLY UPDATED'
                ));
            }
        }
    }
    