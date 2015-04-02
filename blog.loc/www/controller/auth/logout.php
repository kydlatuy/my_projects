<?php

namespace controller\auth;

/**
 * logout controller
 */
class logout {
    
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
        
        session_destroy();
        header("Location: /");
        
    }
    
}
