<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // If user is logged in, show them their home page
        // If not logged in, redirect to the main landing page
        if ($this->getUser()) {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        
        // For non-logged in users, you might want to show index.html.twig instead
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}