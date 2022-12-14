<?php
    session_start();
    //exemple - default : flash('register_success', 'you are registered') / flash('register_error', 'your are not registered', 'alert alert-error');
    //desplay in view - echo flash('register_success');
    function flash($name = "", $message = "", $class = "alert alert-success") {
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){

                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION[$name.'_class'])) {
                    unset($_SESSION[$name.'_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name .'_class'] = $class;
            }elseif(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : "";
                echo '<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'_class']);
            }
        }
    }
    function isLoggedIN() {
        if(isset($_SESSION['user_id'])){
            return true;
        }else {
            return false;
        }
    }