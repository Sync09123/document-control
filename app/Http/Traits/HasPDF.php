<?php

namespace App\Http\Traits;

trait HasPDF{


    public function converToPDF($file,$fileName){

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF'); 
        \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP); 
       return \PhpOffice\PhpWord\IOFactory::load($file); 
      
    }

}