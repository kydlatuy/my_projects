<?php

namespace controller\auth;

/**
 * register controller
 */
class Register {

    /**
     * index method
     */
    public function index(){
        if ($_POST){
            $validation = new \classes\Validation($_POST);
            $validation->setRule('email', 'email');
            $validation->setRule('email', 'required');
            $validation->setRule('email', 'callback_UserEmailExists');
            $validation->setRule('password', 'required');
            $validation->setRule('password_confirm', 'required');
            $validation->setRule('password_confirm', 'equal_password');
            if ($validation->run()) {
                $auth = new \classes\Auth();
                $params = $validation->getData();
                $params['time_created'] = date('Y-m-d H:i:s');
                if ($auth->register($params)){
                    if ($auth->login($validation->get('email'),$validation->get('password'))){
                        header("Location: /profile");
                    }
                }
            } else {
                $validation->printErrors();
            }
        }
        \core\Template::create()->render('auth/register');
    }
}
