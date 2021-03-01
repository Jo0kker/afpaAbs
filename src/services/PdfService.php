<?php


namespace App\services;


use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfReader\PdfReader;

class PdfService
{
    public function createAbsence() {
        $pdf = new Fpdi();


        for ($i = 0; $i < 5; $i++) {
            $pdf = $this->AbsenceAuth($pdf);
        }
        return $pdf;
    }

    public function createActivity() {
        $pdf = new Fpdi();


        for ($i = 0; $i < 5; $i++) {
            $pdf = $this->ActivityAuth($pdf);
        }
        return $pdf;
    }

    private function AbsenceAuth($pdf)
    {

        /* Importation du model */
        $pdf->setSourceFile(__DIR__ . "/../../templates/pdf/AA.pdf");
        $pageId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useImportedPage($pageId, 10 ,10,200);

        /* Test d'écriture */
        $pdf->SetFont('Times');

        $pdf->SetXY(34,78.5);
        $pdf->Write(1, utf8_decode('NOM'));

        $pdf->SetXY(125,78.5);
        $pdf->Write(1, utf8_decode('PRENOM'));

        $pdf->SetXY(55.2,88.8);
        $pdf->Write(1, utf8_decode('FORMATION'));

        $pdf->SetXY(33,101.8);
        $pdf->Write(1, utf8_decode('LIEU'));

        $pdf->SetXY(32,108.6);
        $pdf->Write(1, utf8_decode('H_START'));

        $pdf->SetXY(68,108.6);
        $pdf->Write(1, utf8_decode('H_END'));

        $pdf->SetXY(130,101.8);
        $pdf->Write(1, utf8_decode('J_START'));

        $pdf->SetXY(165,101.8);
        $pdf->Write(1, utf8_decode('J_START'));

        $pdf->SetXY(133,108.6);
        $pdf->Write(1, utf8_decode('NB_JOUR'));

        $pdf->SetXY(23,119.6);
        $pdf->MultiCell(173, 5, utf8_decode('J_START_lorem30qsdqsdqsd64qs65d4q6s54dq5s4qsdq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsddq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsdq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsdq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsdq5s4qsdqsdqsdqsdqsdqsdqsdqsdqsdq5s4qsdqsdqsdqsdqsdqsdqsdqsdqs'));

        $pdf->SetXY(120, 172);
        $pdf->Write(1, utf8_decode('Date_CreatedAt'));

        $pdf->SetXY(160, 172);
        $pdf->Write(1, utf8_decode('FullName_Student'));

        $pdf->SetXY(120, 200);
        $pdf->Write(1, utf8_decode('Date_UdateAt'));

        $pdf->SetXY(160, 200);
        $pdf->Write(1, utf8_decode('FullName_Former'));

        $pdf->SetXY(120, 240);
        $pdf->Write(1, utf8_decode('Avis_RF'));

        $pdf->SetXY(160, 240);
        $pdf->Write(1, utf8_decode('NAME_RF'));
        return $pdf;
    }

    private function ActivityAuth($pdf)
    {
        /* Importation du model */
        $pdf->setSourceFile(__DIR__ . "/../../templates/pdf/APE.pdf");
        $pageId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useImportedPage($pageId, 10 ,10,200);

        /* Test d'écriture */
        $pdf->SetFont('Times');

        $pdf->SetXY(27.5,45);
        $pdf->Write(1, utf8_decode('x'));

        $pdf->SetXY(27.5,48.8);
        $pdf->Write(1, utf8_decode('x'));

        $pdf->SetXY(27.5,52.2);
        $pdf->Write(1, utf8_decode('x'));

        $pdf->SetXY(27.5,56);
        $pdf->Write(1, utf8_decode('x'));

        $pdf->SetXY(55,87.5);
        $pdf->Write(1, utf8_decode('FULLNAME_STUDENT'));

        $pdf->SetXY(68,102.5);
        $pdf->MultiCell(120, 5, utf8_decode('J_START_lorem30qsdqsdqsd64qs65d4qlorem30qsdqsdqsd64qs65d4qlorem30qsdqsdqsd64qs65d4q'));

        return $pdf;
    }
}
