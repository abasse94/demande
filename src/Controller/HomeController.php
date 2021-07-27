<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
 /**
  *@Route("/", name="app_home")
  *
  * @return Response
  */
    public function index(): Response
    {
        return $this->render('home/accueil.html.twig');
    }
}
