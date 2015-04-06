<?php

namespace controller\auth;

/**
 * logout controller
 */
class Logout {
    /**
     * index method
     */
    public function index(){
        session_destroy();
        header("Location: /");
    }
}
