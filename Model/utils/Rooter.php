<?php

namespace App\Model\utils;

class Rooter
{
    public function redirect()
    {

        if (isset($_GET['url'])) :

            //Transorme l'url en tableau
            $url = $_GET['url'];
            if (substr($url, -1) == "/") :
                $newUrl = rtrim($url, "/");
                return header('Location: /' . $newUrl);
            endif;
            
            $url = explode('/', $url);

            if (count($url) == 1) :

                $className = 'App\Controller\\' . $url[0];
                $methodName = 'index';

                $this->classExist($className);

                $instance = new $className();
                $instance->$methodName();

            elseif (count($url) == 2) :

                $className = 'App\Controller\\' . $url[0];
                $methodName = $url[1];

                $this->classExist($className);

                $instance = new $className();
                $instance->$methodName();

            elseif (count($url) == 3) :

                $className = 'App\Controller\\' . $url[0];
                $methodName = $url[1];

                $this->classExist($className);

                if(str_contains($url[2], 'user=') && $url[0] === 'verify' && ($url[1] === 'verifyaccount' || $url[1] === 'passwordRecover')):
                    $array = explode('user=', $url[2]);
                    $token = $array[0];
                    $utilisateur_id = $array[1];
                    $id = compact('token', 'utilisateur_id');
                elseif (!preg_match('/[^0-9]/', $url[2])) :

                    $id = $url[2];
                else :
                    throw new \Exception('Url non valid 1');
                endif;

                $instance = new $className();
                $instance->$methodName($id);

            else :
                throw new \Exception('Url non valid 2');
            endif;

        else :
            return header('Location: /home');
        endif;
    }

    private function classExist($class)
    {
        if (!class_exists($class)) :
            throw new \Exception('Url non valid.');
        endif;
    }

    // public static function Redirect()
    // {
    //     $array = ['home', 'lieux', 'publication', 'login', 'admin','actualite','evenement','organisation','histoire'];

    //     if (isset($_GET['url']) && !empty($_GET['url'])) :
    //         // Transforme l'url en tableau
    //         if(substr($_GET['url'], -1) == "/"):
    //             $newUrl = rtrim($_GET['url'], "/");

    //            return header('Location: /' . $newUrl);
    //         endif;
    //         $url = explode('/', $_GET['url']);

    //         if(in_array($url[0], $array)){
    //             $className = ucfirst($url[0]);

    //             if(isset($url[1]) && !empty($url[1])){
    //                 $methodName = $url[1];
    //             }
    //             else{
    //                 $methodName = 'index';
    //             }
    //             $id ='';
    //             if(isset($url[2])):
    //                 $id = $url[2];
    //             endif;

    //             $instance = new $className();
    //             $instance->$methodName($id);

    //         }
    //         else{
    //             throw new \Exception("Url non valide.");
    //         }


    //     //Absence d'url => page d'acceuil    
    //     else:
    //         return header('Location: /home');
    //     endif;



    //     //instanciation

    // }
}
