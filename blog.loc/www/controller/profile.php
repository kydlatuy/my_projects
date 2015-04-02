<?php

namespace controller;

/**
 * profile controller
 */
class profile {
    
    /**
     * 
     */
    public function __construct() {
        $this->db = \core\DataBase::getConnect();
    }
    
    /**
     * index method
     */
    public function index(){
        
        if (!$_SESSION['islogin']){
            header("Location: /auth/login");
            exit;
        }
        
        $sth = $this->db->prepare(
                        'SELECT *
                             FROM user
                                WHERE id = :id');
        $sth->execute(array(':id' => $_SESSION['userid']));
        $result = $sth->fetchAll();
        
        \core\Template::create()->addVars(array('userdata' => $result[0]));
        \core\Template::create()->render('profile');
        
    }
    
}
