<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 25.05.2018
 * Time: 20:22
 */

namespace App\UltraBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('indse');
    }
}