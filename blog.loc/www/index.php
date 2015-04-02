<?php
/*
 * db damp
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
 */

session_start();

spl_autoload_register(function($class){
    
    $file = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file))
        require_once $file;
    
});

\core\Route::run();


?>