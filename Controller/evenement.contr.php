<?php

namespace App\Controller;

use App\Model\Lieux;
use App\Model\Publication;
use App\Model\Organisation;
use App\Model\utils\Render;

class Evenement
{
    public function index()
    {

        $publication = new Publication();
        $evenement = $publication->getPublication('evenement', '1year');

        $lieu = new Lieux();
        $lieux = $lieu->getHebergeurJoinLieux();

        $geojson = $this->createGeoJson($evenement, $lieux);

        $organisation = new Organisation;
        $logo = $organisation->getLogo();

        $view = 'evenement';
        $array = compact('logo', 'evenement', 'lieux', 'geojson');
        Render::renderer($view, $array);
    }

    private function createGeoJson($evenement, $lieux)
    {
        $geojson = array('type' => 'FeatureCollection', 'features' => array());
        foreach ($evenement as $e) :
            foreach ($lieux as $l) :
                if ($l['publication_id'] == $e['publication_id']) :
                    
                    $marker = array(
                        'type' => 'Feature',
                        "geometry" => array(
                            'type' => 'Point',
                            'coordinates' => array(
                                $l['gps_long'],
                                $l['gps_lat']
                                )
                            ),
                            'properties' => array(
                                'title' => "Mapbox",
                                'description' => $l['nom']
                            ),
                        );
                        
                        
                        $geojson['features'][] = $marker;
                    endif;
                endforeach;

                $array[$e['publication_id']] = $geojson;
                $geojson = array('type' => 'FeatureCollection', 'features' => array());

        endforeach;

        return $array;
    }
}
