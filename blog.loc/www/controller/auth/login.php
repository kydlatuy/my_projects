<?php

namespace controller\auth;
/**
 * login controlled
 */
class Login {
    
    /**
     * 
     */
    public function __construct() {
        ;
    }
    
    /**
     * index method
     */
    public function index(){
        if ($_POST){
            $validation = new \classes\Validation($_POST);
            $validation->setRule('email','email');
            $validation->setRule('email','required');
            $validation->setRule('password','required');
            if ($validation->run()){
                $auth = new \classes\Auth();
                if ($auth->login($validation->get('email'),$validation->get('password'))){
                    header("Location: /profile");
                } else {
                    $auth->printErrors();
                }
            } else {
                $validation->printErrors();
            }
        }
        \core\Template::create()->render('auth/login');
    }
}
