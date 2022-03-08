<?php

namespace App\Public;

session_start();
?>

<?php


use App\Model\utils\Rooter;
use App\Model\utils\Exception;


try {

    spl_autoload_register(function ($class) {

        $className = str_replace('\\', '/', $class);
        if (str_contains($className, 'Controller')) :
            $array = explode('/', $className);
            $array[2] = lcfirst($array[2]);
            $className = implode('/', $array);

            if (str_contains($className, 'App')) :
                $className = str_replace('App', '..', $className);
                $className = $className . '.contr.php';
            else :
                $className = '../' . $className . '.contr.php';
            endif;
        elseif (str_contains($className, 'Model')) :
            $className = str_replace('App', '..', $className);

            $className = $className . '.php';
        else :
            throw new \Exception('Un problème est survenu.');
        endif;
        if (!file_exists($className)) :
            throw new \Exception('URL non valide.');
        endif;

        require_once($className);
    });


    $rooter = new Rooter();
    $rooter->redirect();
} catch (\Exception $e) {

    Exception::handle_Exception($e);
}
