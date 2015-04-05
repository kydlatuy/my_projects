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
        'db' => 'users',
        'user' => 'root'
    );

    /**
     * pdo connect yo database
     * @return PDOConnect
     */

     /**
     * pdo connect yo database
     * @return PDOConnect
     */

    public static function getConnect(){

        if (!self::$dbh){
            $config = self::$config;
            try {
                self::$dbh = new \PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user']);
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        //var_dump("good");
        return self::$dbh;
    }

}