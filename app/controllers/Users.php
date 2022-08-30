<?php
    class Users extends Controller{
        public function __construct () {
            $this->userModel = $this->model('User');
        }

        public function register () {
            //check if the methode requested is POST
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //Process the from
                $data = [
                    'name' => htmlspecialchars(trim($_POST['name'])),
                    "email" => htmlspecialchars(trim($_POST['email'])),
                    "password" => htmlspecialchars(trim($_POST['password'])),
                    "password_confirm" => htmlspecialchars(trim($_POST['password_confirm'])),
                    "name_err" => "",
                    "email_err" => "",
                    "password_err" => "",
                    "password_confirm_err" => ""
                ];

                //validate name
                if(empty($data['name'])) {
                    $data['name_err'] = "Please Enter name";
                }

                //validate email
                if(empty($data['email'])) {
                    $data['email_err'] = "Please Enter email";
                }else{
                    //check if the email is token
                    if($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "This Email Already Taken";
                    }
                }

                //validate password
                if(empty($data['password'])) {
                    $data['password_err'] = "Please Enter password";
                }elseif(strlen($data['password']) < 8) {
                    $data['password_err'] = "Password must be at least 8 characters";
                }

                //validate password_confirm
                if(empty($data['password_confirm'])) {
                    $data['password_confirm_err'] = "Please Enter password_confirm";
                }else{
                    if($data['password'] != $data['password_confirm']) {
                        $data['password_confirm_err'] = "Password not match";
                    }
                }

                //make sure the errors are empty
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_confirm_err'])) {
                    //everything is oky
                    //hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //add user
                    if($this->userModel->addUser($data)){
                        flash('register_success', 'you are now register you can login.');
                        redirecte("users/login");
                    }else {
                        die("someThing Goes Wrong");
                    }
                }else {
                    //load the view
                    $this->view("users/register", $data);
                }

            }else {
                //init data
                $data = [
                    'name' => "",
                    "email" => "",
                    "password" => "",
                    "password_confirm" => "",
                    "name_err" => "",
                    "email_err" => "",
                    "password_err" => "",
                    "password_confirm_err" => ""
                ];
                //load the view
                $this->view("users/register", $data);
            }
        }

        public function login () {
            //check if the methode requested is POST
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //Process the from
                $data = [
                    "email" => htmlspecialchars(trim($_POST['email'])),
                    "password" => htmlspecialchars(trim($_POST['password'])),
                    "email_err" => "",
                    "password_err" => ""
                ];

                //validate email
                if(empty($data['email'])) {
                    $data['email_err'] = "Please Enter email";
                }

                //validate password
                if(empty($data['password'])) {
                    $data['password_err'] = "Please Enter password";
                }

                //check if user existe
                if($this->userModel->findUserByEmail($data['email'])) {
                    //user existe
                    
                }else {
                    $data['email_err'] = "the user not found";
                }

                //make sure the errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])) {
                    //everything is oky
                    //check and set logged user
                    $loggedInUser = $this->userModel->loggin($data['email'], $data['password']);
                    if($loggedInUser){
                        //creat session
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data['password_err'] = "the password incorrect";
                        $this->view("users/login", $data);
                    }

                }else {
                    //load the view
                    $this->view("users/login", $data);
                }


            }else {
                //init data
                $data = [
                    "email" => "",
                    "password" => "",
                    "email_err" => "",
                    "password_err" => "",
                ];
                //load the view
                $this->view("users/login", $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirecte("posts");
        }

        public function logout() {
            unset($_SESSIOn["user_id"]);
            unset($_SESSIOn["email"]);
            unset($_SESSIOn["name"]);
            session_destroy();
            redirecte("users/login");
        }

        public function isLoggedIN() {
            if(isset($_SESSION['user_id'])){
                return true;
            }else {
                return false;
            }
        }
    }