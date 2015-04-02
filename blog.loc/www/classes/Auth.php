<?php

namespace classes;
/**
 * auth class
 */
class Auth {
    
    /**
     *
     * @var PDOObject 
     */
    private $db;
    
    /**
     *
     * @var array errors 
     */
    private $error;
    
    /**
     * 
     */
    public function __construct() {
        
        $this->db = \core\DataBase::getConnect();
        
    }
    
    /**
     * login
     * @param string $email - email
     * @param string $pass - password
     * @return boolean
     */
    public function login($email, $pass){

        $sth = $this->db->prepare(
                        'SELECT *
                             FROM user
                                WHERE email = :email');
        $sth->execute(array(':email' => $email));
        $result = $sth->fetchAll();

        if (count($result) == 0){
            $this->error[] = "user not found";
            return false;
        }
        $user = $result[0];
        
        if ($user)
            
        $passwordDb = $user['password'];
        
        if (md5($pass) == $passwordDb){
            $this->setUserData($user);
            return true;
        } else {
            $this->error[] = "wrong password";
            return false;
        }
        
        
        
    }
    
    /**
     * register
     * @param array $data
     * @return boolean
     */
    public function register($data){
        
        $stmt = $this->db->prepare("INSERT INTO user (email, password, phone, name) VALUES (:email, :password, :phone, :name)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':password', md5($data['password']));
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);

        try {
            $stmt->execute();
            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
        
    }
    
    /**
     *  print errors
     */
    public function printErrors(){
        
        if (count($this->error) > 0){
            foreach ($this->error as $err){
                echo $err . '<br/>';
            }
        }
        
    }
    
    /**
     * set user data
     * @param array $data
     */
    private function setUserData($data){
        
        $_SESSION['islogin'] = 1;
        $_SESSION['userid'] = $data['id'];
        
    }
    
}