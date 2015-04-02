<?php

namespace controller;

/**
 * default main controller
 */
class main {
    
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
