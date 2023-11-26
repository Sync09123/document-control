<?php

namespace App\Http\Traits;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
trait HasQR{



    public function generateQR($name){



        return  QrCode::generate(
            'Hello, World!',
        );
    }


     
}