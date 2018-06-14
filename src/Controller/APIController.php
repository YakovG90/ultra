<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIController extends Controller
{

    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        if(isset($_GET['charname'])&&$_GET['realmname']) {
            $key = 'wpgp8ngd48ts8nhbgm6mpbyvzj2q62yd';
            $url = file_get_contents("https://eu.api.battle.net/wow/character/" . $_GET['realmname'] . "/" . $_GET['charname'] . "?locale=en_GB&apikey=" . $key);
            $json_a = json_decode($url, true);
            $profile_img_url = "http://render-eu.worldofwarcraft.com/character/" . $json_a['thumbnail'];

            return $this->render('api/api.html.twig', [
                'controller_name' => 'APIController',
                'profile_name' => $json_a['name'],
                'profile_realm' => $json_a['realm'],
                'profile_thumbnail' => $profile_img_url
            ]);
        }
        else{
            return $this->render('api/api.html.twig', [
                'testvar'=>isset($_GET['charname'])
            ]);
        }
    }
}