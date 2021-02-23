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
        //dd(__DIR__);
        try {
            $pageCount = $pdf->setSourceFile(__DIR__ . "/../../templates/pdf/AA.pdf");
        } catch (\Exception $e) {
            dd($e);
        }
        $pageId = $pdf->importPage(1);

        $pdf->AddPage();
        $pdf->useImportedPage($pageId, 10 ,10,200);
        return $pdf;
    }
}
