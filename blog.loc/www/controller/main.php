<?php

namespace controller;

/**
 * default main controller
 */
class Main {

    /**
     * index method
     */

    public function index(){
        \core\Template::create()->render('start_page');
    }
}
