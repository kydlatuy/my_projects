<?php

namespace classes;

/**
 * class validation
 */
class Validation{
    
    /**
     *
     * @var array - data for validation 
     */

    private $data;
    
    /**
     *
     * @var PDOObject 
     */

    private $db;
    
    /**
     *
     * @var array - errors 
     */

    private $error = array();
    
    /**
     *
     * @var array for balidation rule 
     */

    private $fieldRule;

    /**
     * 
     * @param array $data
     */

    public function __construct($data){
        $this->db = \core\DataBase::getConnect();
        $this->data = $data;
    }
    
    /**
     * set rule
     * @param string $field
     * @param string $rule
     */

    public function setRule($field, $rule){
        $this->fieldRule[$field][] = $rule;
    }
    
    /**
     * run validation
     * @return boolean
     */

    public function run(){
        if (count($this->fieldRule)){
            foreach ($this->fieldRule as $key => $field){
                foreach ($field as $rule){
                    if (strstr($rule,'equal')){
                        $fieldEqual = end(explode('_', $rule));
                        $this->equal($key,$this->data[$key],$this->data[$fieldEqual]);
                    }elseif (strstr($rule,'callback')){
                        $ruleMethod = end(explode('_', $rule));
                        $this->$ruleMethod($key,$this->data[$key]);
                    }else {               
                        $this->$rule($key,$this->data[$key]);
                    }
                }
            }
            if (count($this->error) > 0){
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    /**
     * validation email
     * @param string $key
     * @param string $field
     */

    private function email($key,$field){
        if (!filter_var($field, FILTER_VALIDATE_EMAIL)){
            $this->error[] = "$key is not valid";
        }
    }
    
    /**
     * valid field required
     * @param string $key
     * @param string $field
     */

    private function required($key,$field){
        if (!$field || empty($field)){
            $this->error[] = "$key is required";
        }
    }
    
    /**
     * valid equal password
     * @param string $key
     * @param string $field1
     * @param string $field2
     */

    private function equal($key,$field1, $field2){
        if ($field1 != $field2){
            $this->error[] = "$key is not equal $field2";
        }
    }
    
    /**
     * preint error
     */

    public function printErrors(){
        if (count($this->error) > 0){
            foreach ($this->error as $err){
                echo $err . '<br/>';
            }
        }
    }
    
    /**
     * callback validation email exists
     * @param string $key
     * @param string $field
     */

    private function UserEmailExists($key,$field){
        $sth = $this->db->prepare(
                        'SELECT id
                             FROM user
                                WHERE email = :email');
        $sth->execute(array(':email' => $field));
        $result = $sth->fetchAll();
        if (count($result)){
            $this->error[] = "$key is exists";
        }
    }
    
    /**
     * get field by key
     * @param string $key
     * @return string
     */

    public function get($key){
        if (array_key_exists($key, $this->data)){
            return trim(strip_tags($this->data[$key]));
        }
    }
    
    /**
     * get all data
     * @return array
     */

    public function getData(){
        $data = array_map('trim', $this->data);
        $data = array_map('strip_tags', $data);
        return $data;
    }
}