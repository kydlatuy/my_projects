<?php

namespace core;

/**
 * class templation
 */
class Template {
    
    /**
     *
     * @var instanse object 
     */

    private static $object;
    
    /**
     *
     * @var array template vard
     */

    public $var = array();
    
    /**
     * 
     * @return object this class
     */

    public static function create(){
        if (!self::$object){
            self::$object = new self();
        }
        return self::$object;
    }
    
    /**
     * add var to template
     * @param array $arr
     */

    public function addVars($arr){
        $this->var = array_merge($this->var, $arr);

    }
    
    /**
     * rendering method
     * @param string $view
     * @param boolean $ignoreWrap
     * @return html
     */

    public function render($view,$ignoreWrap = false){
        ob_start();
        extract($this->var);
        include_once "view/$view.php";
        $content = ob_get_clean();
        if ($ignoreWrap){
            echo $content;
        } else {
            include_once 'view/main.php';
        }
    }
}