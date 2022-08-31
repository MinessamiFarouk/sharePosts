<?php
    class Posts extends Controller {
        public function __construct() {
            if(!isLoggedIN()) {
                redirecte("users/login");
            }

            $this->postModel = $this->model("Post");
        }

        public function index() {
            $posts = $this->postModel->getPosts();

            $data = [
                "posts" => $posts
            ];
            
            $this->view("Posts/index", $data);
        }

        public function add() {
            $data = [
                "title" => "",
                "body" => ""
            ];

            $this->view("Posts/add", $data);
        }
        
    }