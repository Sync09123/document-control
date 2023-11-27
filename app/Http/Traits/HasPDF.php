<?php

namespace App\Http\Traits;
use setasign\Fpdi\Fpdi;
trait HasPDF
{


    public function converToPDF($file, $fileName)
    {

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP);
        return \PhpOffice\PhpWord\IOFactory::load($file);

    }


    public function fillPDFFile($file, $outputFilePath,$ref_id)
    {

        $fpdi = new FPDI;


        $count = $fpdi->setSourceFile($file);

        for ($i = 1; $i <= $count; $i++) {


            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            $fpdi->SetFont("Times", "", 10);
            $fpdi->SetTextColor(169, 169, 169);
            $top = 23;
            $text = "Verify here";
            $fpdi->Text($size['width'] - 20, $top, $text);

            $fpdi->Image(public_path('documents/qr/'.$ref_id.'.png'), $size['width'] - 20, 2, 17, 17);

        }



        return $fpdi->Output($outputFilePath, 'F');

    }


}