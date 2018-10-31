<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.10.31
 * Time: 10.17
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
//    /**
//     * @Route("/", name="home")
//     */
    public function homeAction()
    {

        $number = rand(1,100);
        return $this->render('home/home.html.twig');
    }
}