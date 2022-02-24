<?php
session_start();

use Model\utils\Rooter;
use Model\utils\Exception;

// spl_autoload_register(function ($className) {
//     $className = str_replace('\\', '/', $className);
//     if ($className == 'Rooter') :
//         $className = '../Model/utils/Rooter.php';
//     else :
//         if (preg_match('/Controller/', $className)) :
//             $className = '../' . $className . '.contr.php';
//         elseif (preg_match('/Model/', $className)) :
//             $className = '../' . $className . '.php';
//         else :
//             $className = '../Controller/' . $className . '.contr.php';
//         endif;
//     endif;
//     require_once($className);
// });

require_once('../Model/utils/Rooter.php');
require_once('../Model/utils/Database.php');
require_once('../Model/utils/Render.php');
require_once('../Model/utils/Exception.php');
require_once('../Model/Publication.php');
require_once('../Model/Organisation.php');
require_once('../Model/Lieux.php');
require_once('../Model/Membre.php');
require_once('../Model/Utilisateur.php');
require_once('../Controller/home.contr.php');
require_once('../Controller/actualite.contr.php');
require_once('../Controller/evenement.contr.php');
require_once('../Controller/login.contr.php');
require_once('../Controller/lieux.contr.php');
require_once('../Controller/publication.contr.php');
require_once('../Controller/admin.contr.php');


try {
    Rooter::Redirect();
} catch (\Exception $e) {
    Exception::handle_Exception($e);
}
