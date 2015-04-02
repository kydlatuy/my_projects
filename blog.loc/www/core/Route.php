<?php

namespace core;
/**
 * class routing
 */
class Route {
    
    
    /**
     * method for routing url
     */
    public static function run() {
        
        $request = $_SERVER['REQUEST_URI'];
        
        if ($request == '/'){
            $controller = "\controller\main";          
        } else {
            $controller = "\controller" . str_replace('/', '\\', $request);          
        }
        
        $object = new $controller;
        
        $object->index();
        
    }
   

    
}

