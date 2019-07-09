<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/h", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/accueil.html.twig');
    }
}
