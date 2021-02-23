<?php


namespace App\services;


use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfReader\PdfReader;

class PdfService
{
    public function AbsenceAuth(): \FPDF
    {
        $pdf = new Fpdi();

        /* Importation du model */
        $pdf->setSourceFile(__DIR__ . "/../../templates/pdf/AA.pdf");
        $pageId = $pdf->importPage(1);
        $pdf->AddPage();
        $pdf->useImportedPage($pageId, 10 ,10,200);

        /* Test d'écriture */
        $pdf->SetFont('Times');
        $pdf->SetXY(30,30);
        $pdf->Write(1, utf8_decode('Bonjour à toi'));

        $pdf->SetXY(60, 40);
        $pdf->Write(1, utf8_decode('je suis toujours là'));


        return $pdf;
    }
}
