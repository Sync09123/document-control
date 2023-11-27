<?php

namespace App\Http\Controllers;


use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
class QrCodeController extends Controller
{
    //
    public function show()
    {
        $image = QrCode::format('png')
      
        ->size(200)->errorCorrection('H')
        ->generate('A simple example of QR code!');
$output_file = '/img/qr-code/img-' . time() . '.png';
Storage::disk('local')->put($output_file, $image);
    }
}
