<?php

namespace App\Controller;

use App\services\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AbsController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/abs", name="abs")
     */
    public function index(PdfService $fpsf): Response
    {
        $fpdf = $fpsf->AbsenceAuth();


        return new Response($fpdf->Output('I', 'gene.pdf'), 200, array(
            'Content-Type' => 'application/pdf'));

    }
}
