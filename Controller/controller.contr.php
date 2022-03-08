<?php

namespace App\Controller;

abstract class Controller
{
    protected function set_message($message, $type , $code = 'flash')
    {
        $array = compact('message', 'type', 'code');
        $_SESSION['message'][] = $array;

    }

    protected function get_message(){

        $array = [];

        if(isset($_SESSION['message'])):
            $array = $_SESSION['message'];
            unset($_SESSION['message']);
        endif;

        return $array;
    }

}