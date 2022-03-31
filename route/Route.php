<?php
    class Route {

        private $_uri = array();
        private $_method = array();

        public function add($uri,$method = null){
            $this->_uri[] = '/' . trim($uri,'/');

            if ($method!= null){
                $this->_method[] = $method;
            }
        }

        public function submit(){

            $param = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
            
            foreach($this->_uri as $key => $value){
                
                if(preg_match("#^$value$#", $param)){
                    $useMethod = $this->_method[$key];
                    new $useMethod;
                }
            }

        }

    }