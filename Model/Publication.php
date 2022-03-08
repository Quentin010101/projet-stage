<?php

namespace App\Model;

use DateTime;
use App\Model\utils\Database;

class Publication
{
    public function set($date, $titre, $sous_titre, $text, $illustration, $userType)
    {

        $query = 'INSERT INTO publication(utilisateur_id, date_publication, date_event, titre, sous_titre, text, illustration, type) VALUES(:utilisateur_id, NOW(), :date_event, :titre, :sous_titre, :text, :illustration, :type)';

        $utilisateur_id = $_SESSION['user-id'];
        $date_event = $date;

        if ($userType === 'redacteur-actualite') :
            $type = 'actualite';
        elseif ($userType === 'redacteur-evenement') :
            $type = 'evenement';
        endif;

        $array = compact('utilisateur_id', 'date_event', 'titre', 'sous_titre', 'text', 'illustration', 'type');

        $db = new Database();
        $db->action($query, $array);

        $queryId = 'SELECT publication_id FROM publication ORDER BY publication_id DESC LIMIT 1';
        $request = $db->findOne($queryId,[]);
        
        return $request;
    }

    public function getPublication($publication_type, $period)
    {
        if ($period == '1year') :
            $date = new DateTime('- 1year');
        elseif ($period == '1month') :
            $date = new DateTime('- 1month');
        endif;

        $date = $date->format('Y-m-d');

        $query = 'SELECT * FROM publication WHERE type = :type AND date_publication > :date ORDER BY date_publication DESC';

        $type = $publication_type;
        $array = compact('type', 'date');

        $db = new Database();
        $request = $db->findAll($query, $array);

        return $request;
    }
}
