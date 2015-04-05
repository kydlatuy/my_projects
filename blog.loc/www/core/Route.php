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
        //print_r($request);
        if ($request == '/'){
            $controller = "\controller\main";
        } else {
            $controller = "\controller" . str_replace('/', '\\', $request);
        }


        
        $object = new $controller;
        //var_dump($object);
        //print_r($object);
        
        $object->index();
        
    }
   

    
}

