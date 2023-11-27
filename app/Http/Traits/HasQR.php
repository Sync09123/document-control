<?php

namespace App\Http\Traits;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
trait HasQR{



    public function generateQR($name){



        return  QrCode::format('png')->generate(
            env('QR_SCANNER_URL') .'/'.$name
        );
    }


    public function fillPDFFile($file, $outputFilePath)

    {

        $fpdi = new FPDI;

          

        $count = $fpdi->setSourceFile($file);

  

        for ($i=1; $i<=$count; $i++) {

  

            $template = $fpdi->importPage($i);

            $size = $fpdi->getTemplateSize($template);

            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));

            $fpdi->useTemplate($template);

              

             $fpdi->SetFont("Times", "", 10);

             $fpdi->SetTextColor(169,169,169);

  

            // $left = 10;

            $top = 23;

             $text = "Verify here";

             $fpdi->Text($size['width']-20,$top,$text);
         
  

            $fpdi->Image( public_path('img-1701077981.png'),$size['width']-20,2,17,17);

        }

  

        return $fpdi->Output($outputFilePath, 'F');

    }

     
}