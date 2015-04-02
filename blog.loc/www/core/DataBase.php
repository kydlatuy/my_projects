<?php

namespace core;

/**
 * class for database connect
 */
class DataBase {
     
    /**
     *
     * @var PDOObject 
     */
    private static $dbh;


    /**
     *
     * @var array database option 
     */
    private static $config = array(
        'host' => 'localhost',
        'pass' => 'fylhsq1',
        'db' => 'testing',
        'user' => 'root'
    );
    

    
    /**
     * pdo connect yo database
     * @return PDOConnect
     */
    public static function getConnect(){
        
        if (!self::$dbh){
            $config = self::$config;
            try {
                self::$dbh = new \PDO("mysql:host=localhost;dbname=users", "root");
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
            
        }
        
        return self::$dbh;
        
    }
}