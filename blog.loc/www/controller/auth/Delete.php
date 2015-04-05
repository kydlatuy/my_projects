<?php
/**
 * Created by PhpStorm.
 * User: Melikov
 * Date: 03.04.15
 * Time: 13:00
 */

namespace controller\auth;


class Delete {
    public function index(){
        $auth = new \classes\Auth();
        $auth->delete();
        session_destroy();
        header("Location: /");
    }
}



/*
  if ($validation->run()) {
                 $auth = new \classes\Auth();
                 $params = $validation->getData();
                 $params['updated_date'] = date('Y-m-d H:i:s');
                 if ($auth->update($params)) {
                     echo 'Update success';
                     //$time = date('Y-m-d H:i:s');
                     //$auth->update($time);
                 }
                 else{
                     echo "Feild";
                 }
             }
 */