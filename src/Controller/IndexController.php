<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 25.05.2018
 * Time: 21:04
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {

        return $this->render('index/show.html.twig', [
            'title' => 'Not Not Retarded'
        ]);
    }
}