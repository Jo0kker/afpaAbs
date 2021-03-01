<?php

namespace App\Controller;

use App\services\AfpaConnectService;
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
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('abs/index.html.twig', [

        ]);
    }

    /**
     * @Route("/abs", name="abs")
     */
    public function pdfTest(PdfService $fpsf): Response
    {
        $fpdf = $fpsf->createActivity();

        return new Response($fpdf->Output('I', 'gene.pdf'), 200, array(
            'Content-Type' => 'application/pdf'));

    }

    /**
     * @Route("/test", name="test")
     * @param AfpaConnectService $afpaConnect
     */
    public function test(AfpaConnectService $afpaConnect)
    {
        dd($afpaConnect->getUsers());
    }
}

