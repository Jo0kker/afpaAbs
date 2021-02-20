<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbsController extends AbstractController
{
    /**
     * @Route("/abs", name="abs")
     */
    public function index(): Response
    {
        return $this->render('abs/index.html.twig', [
            'controller_name' => 'AbsController',
        ]);
    }
}
