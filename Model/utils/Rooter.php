<?php


class Rooter
{
    public static function Redirect(){

        $className = 'Home';
        $methodName = 'show';

        if(isset($_GET['page']) && isset($_GET['method']) && !empty($_GET['page']) && !empty($_GET['method'])):

            $className = ucfirst($_GET['page']);
            $methodName = $_GET['method'];

        endif;

        //instanciation
        require('./Controller/' . lcfirst($className) . '.contr.php');
        $instance = new $className();
        $instance->$methodName();
        
    }
}