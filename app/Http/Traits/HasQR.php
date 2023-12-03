<?php

namespace App\Http\Traits;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Storage;

trait HasQR
{



    public function generateQR($name)
    {

        $image = QrCode::format('png')
        ->size(200)->errorCorrection('H')
        ->generate(
            env('CLIENT_URL') . $name

        );
        $output_file = '/documents/qr/' .$name . '.png';
   
        Storage::disk('public')->put($output_file, $image);
    }


   

}