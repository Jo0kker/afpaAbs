<?php

namespace App\Controller;

use DateTime;
use App\Entity\Absence;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(HttpFoundationRequest $request): Response
    {
        $absence = new Absence();

        $form = $this->createFormBuilder($absence)
            ->add('date_start', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('date_end', DateTimeType::class)
            ->add('reason')
            ->getForm('');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $absence->setCreatedAt(new \DateTime());
        }

        dump($absence);
        return $this->render('student/index.html.twig', [
            'formAbsence' => $form->createView()
        ]);
    }
}
