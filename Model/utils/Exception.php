<?php

namespace Model\utils;

require_once('Model/utils/Render.php');
use Render;

class Exception
{
    public static function handle_Exception($e){

        $message = $e->getMessage();
        $view = 'exception/exception';
        $array = compact('message');
        Render::render($view, $array);    
    }
}