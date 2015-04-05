<?php

namespace controller\auth;

/**
 * register controller
 */
class Register {

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

                    //echo 'Register success';
                    \core\Template::create()->render('profile');
                }
            } else {
                $validation->printErrors();
            }
        }
        \core\Template::create()->render('auth/register');
    }

}
