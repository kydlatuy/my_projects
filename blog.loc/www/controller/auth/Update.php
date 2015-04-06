<?php
/**
 * Created by PhpStorm.
 * User: Melikov
 * Date: 03.04.15
 * Time: 14:05
 */

namespace controller\auth;


use classes\Auth;

class Update {

    /**
     * update method
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
            if ($validation->run()){
                $auth = new \classes\Auth();
                $params = $validation->getData();
                $params['updated_date'] = date('Y-m-d H:i:s');
                if ($auth->update($params)){
                    if ($auth->login($validation->get('email'),$validation->get('password'))){
                        header("Location: /profile");
                    }
                }
            } else {
                $validation->printErrors();
            }
        }
        \core\Template::create()->render('auth/update');
    }
} 