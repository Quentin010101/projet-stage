<?php

namespace App\Model\utils;

use App\Model\utils\Render;


class Exception
{
    public static function handle_Exception($e){

        $message = $e->getMessage();
        $view = 'exception/exception';
        $array = compact('message');
        Render::renderer($view, $array);    
    }
}