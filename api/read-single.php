<?php
    class ReadSingle{

        public function __construct()
        {
            $this->run();
        }

        public function run(){
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');

            include './config/Database.php';
            include './models/Forms.php';

            $database = new Database();
            $db = $database->connect();

            $form = new Forms($db);

            $form->id = isset($_GET['id']) ? $_GET['id'] : die();

            $form->readSingle();
        
            $data_arr = array(
                "id" => $form->id,
                "name" => $form->name,
                "email" => $form->email,
                "message" => $form->message,
                "date_posted" => $form->date_posted,
                "approved" => $form->approved
            );

            print_r(json_encode($data_arr));

        }
    }