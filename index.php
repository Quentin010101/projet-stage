<?php
session_start();

use Model\utils\Exception;

// spl_autoload_register(function($className){
//     $className = str_replace('\\', '/', $className);
//     $className = $className . '.php';
//     require_once($className);
// });


require_once('Model/utils/Rooter.php');
require_once('Model/utils/Exception.php');

try{

    Rooter::Redirect();
    
}catch(\Exception $e){

    Exception::handle_Exception($e);

}