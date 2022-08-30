<?php
    class Posts extends Controller {
        public function __construct() {
            if(!isset($_SESSION['user_id'])) {
                redirecte("users/login");
            }
        }
        public function index() {
            $data = [];
            $this->view("Posts/index", $data);
        }
        
    }