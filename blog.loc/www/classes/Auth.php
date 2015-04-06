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

    public function register($params){
        $stmt = $this->db->prepare("INSERT INTO user (email, first_name, last_name, password, time_created) VALUES (:email, :first_name, :last_name, :password, :time_created)");
        $stmt->bindParam(':email', $params['email']);
        $stmt->bindParam(':first_name', $params['firstName']);
        $stmt->bindParam(':last_name', $params['lastName']);
        $stmt->bindParam(':password', md5($params['password']));
        $stmt->bindParam(':time_created', $params['time_created']);
        try {
            $stmt->execute();
            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    /**
     * delete
     *
     */
    public function delete(){
        $sql = $this->db->prepare("DELETE from `user` where `id`=:id");
        $id = $_SESSION['userid'];
        $sql->bindParam(':id', $id);
        try{
            $sql->execute();
            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    /**
     * update
     */
    public function update($data){
        $sql = $this->db->prepare("UPDATE `user` SET `email`=:email,`last_name`=:last_name, `first_name`=:first_name, `password`=:password  where `id`=:id");
        $sql->bindParam(':email', $data['email']);
        $sql->bindParam(':first_name', $data['firstName']);
        $sql->bindParam(':last_name', $data['lastName']);
        $sql->bindParam(':password', md5($data['password']));
        //$sql->bindParam(':last_updated', $data['updated_date']);
        $id = $_SESSION['userid'];
        $sql->bindParam(':id', $id);
        try {
            $sql->execute();
            return true;
        }
        catch (\PDOException $ex) {
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