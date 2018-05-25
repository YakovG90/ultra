<?php
/**
 * Created by PhpStorm.
 * User: yakov
 * Date: 25.05.2018
 * Time: 19:40
 */

namespace App\Controller;





use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }
}