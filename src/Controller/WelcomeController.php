<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_entry')]
    public function index(): Response
    {

        return $this->render('base.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }

}
