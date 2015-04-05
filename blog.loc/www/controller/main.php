<?php

namespace controller;

/**
 * default main controller
 */
class Main {
    
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
        
        \core\Template::create()->render('start_page');
        
    }
    
}
