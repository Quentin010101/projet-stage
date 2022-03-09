<?php

namespace App\Controller;

use App\Model\utils\Render;

class Condition
{
    public function mention_legale(){

        $view = 'mention-legale';
        $array = [];

        Render::renderer($view, $array);

    }

    public function condition_generale(){

        $view = 'condition-generale';
        $array = [];

        Render::renderer($view, $array);
    }
}