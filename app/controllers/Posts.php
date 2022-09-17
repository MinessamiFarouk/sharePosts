<?php
    class Posts extends Controller {
        public function __construct() {
            if(!isLoggedIN()) {
                redirecte("users/login");
            }

            $this->postModel = $this->model("Post");
            $this->userModel = $this->model("User");
        }

        public function index() {
            $posts = $this->postModel->getPosts();

            $data = [
                "posts" => $posts
            ];
            
            $this->view("Posts/index", $data);
        }

        public function add() {

            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $data = [
                    'title' => htmlspecialchars(trim($_POST['title'])),
                    'body' => htmlspecialchars(trim($_POST['body'])),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => "",
                    'body_err' => "" 
                ];

                //validate data
                if(empty($data['title'])) {
                    $data['title_err'] = "Please enter title";
                };

                if(empty($data['body'])) {
                    $data['body_err'] = "Please enter body text";
                };


                //make sure there is no errors
                if(empty($data['title_err']) && empty($data['body_err'])) {
                
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'The Post Added.');
                        redirecte("posts");

                    }else {
                        die("someThing Goes Wrong");
                    }

                }else {
                    $this->view("posts/add", $data);
                }

            }else {

                $data = [
                    "title" => "",
                    "body" => ""
                ];
                
                $this->view("posts/add", $data);
            }

        }

        public function edit($id) {

            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $data = [
                    'post_id' => $id,
                    'title' => htmlspecialchars(trim($_POST['title'])),
                    'body' => htmlspecialchars(trim($_POST['body'])),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => "",
                    'body_err' => "" 
                ];

                //validate data
                if(empty($data['title'])) {
                    $data['title_err'] = "Please enter title";
                };

                if(empty($data['body'])) {
                    $data['body_err'] = "Please enter body text";
                };


                //make sure there is no errors
                if(empty($data['title_err']) && empty($data['body_err'])) {
                
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'The Post Updated.');
                        redirecte("posts");

                    }else {
                        die("someThing Goes Wrong");
                    }

                }else {
                    $this->view("posts/edit", $data);
                }

            }else {
                //check if i'm the owner
                $post = $this->postModel->getPostById($id);
                
                if($post->user_id != $_SESSION['user_id']) {
                    redirecte("posts");
                }
                
                $data = [
                    "id" =>$id,
                    "title" => $post->title,
                    "body" => $post->body
                ];
                
                $this->view("posts/edit", $data);
            }

        }

        public function delete($id) {
             if($_SERVER["REQUEST_METHOD"] == "POST") {
                //check if i'm the owner
                $post = $this->postModel->getPostById($id);
                    
                if($post->user_id != $_SESSION['user_id']) {
                    redirecte("posts");
                }

                if($this->postModel->deletePost($id)){
                    flash('post_message', 'The Post DELETED.');
                    redirecte("posts");
                    
                }else {
                    die("someThing Goes Wrong");
                }
            }else{
                redirecte("posts");
             }
        }

        public function show($id) {
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);

            $data = [
                "post" => $post,
                "user" => $user
            ];

            $this->view("posts/show", $data);
        }
        
    }