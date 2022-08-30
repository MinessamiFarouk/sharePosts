<?php
    /*
        * The Based Controller
        * Loads The Views & Models
    */
    class Controller {
        //Load The Model
        public function model($model) {
            //require the model
            require_once "../app/models/" . $model . ".php";

            //Instantait the model
            return new $model();
        }

        //Load the Views
        public function view($view, $data = []) {
            //check if the view is exist
            if(file_exists("../app/views/" . $view . ".php")) {
                //require the view
                require_once "../app/views/" . $view . ".php";
            }else {
                die("the view does not exist");
            }
        }
    }