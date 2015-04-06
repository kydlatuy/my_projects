<?php
/**
 * Created by PhpStorm.
 * User: Melikov
 * Date: 03.04.15
 * Time: 13:00
 */

namespace controller\auth;


class Delete{
    public function index(){
        $auth = new \classes\Auth();
        $auth->delete();
        session_destroy();
        header("Location: /");
    }
}
