<?php

namespace controller\auth;

/**
 * register controller
 */
class register {

    /**
     * 
     */
    public function __construct() {
        ;
    }

    /**
     * index method
     */
    public function index() {
        if ($_POST) {
            $validation = new \classes\Validation($_POST);
            $validation->setRule('email', 'email');
            $validation->setRule('email', 'required');
            $validation->setRule('email', 'callback_UserEmailExists');
            $validation->setRule('password', 'required');
            $validation->setRule('password_confirm', 'required');
            $validation->setRule('password_confirm', 'equal_password');
            if ($validation->run()) {
                $auth = new \classes\Auth();
                if ($auth->register($validation->getData())) {
                    echo 'Register success';
                }
            } else {
                $validation->printErrors();
            }
        }
        \core\Template::create()->render('auth/register');
    }

}
