<?php
    /*
        * App Core Class
        * Create URL & loads Controller
        * URL FORMAT - Will Be Like : /controller/method/params 
    */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->geturl();

            //look in controllers for first value
            if(isset($url)) {
                if(file_exists("../app/controllers/". ucwords($url[0]) . ".php")) {
                    // if existe, then set as controller
                    $this->currentController = ucwords($url[0]);
    
                    //Unset 0 Index or delete index 0
                    unset($url[0]);
                }
            }
            
            //Require the controller
            require_once "../app/controllers/{$this->currentController}.php";

            //instantaite the controler
            $this->currentController = new $this->currentController;

            //check fro the second part of the url
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])) {
                    // if existe, then set as Method
                    $this->currentMethod = $url[1];

                    //Unset 1 Index or delete index 1
                    unset($url[1]);
                }
            }


            // Get Params
            $this->params = $url ? array_values($url) : [];

            // call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function geturl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }