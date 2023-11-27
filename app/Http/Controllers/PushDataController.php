<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Arr;

class PushDataController extends Controller
{
    //


    public function pushToClient()
    {

     //   $this->pushRepo();
        $documents = Document::with(['user', 'userInfo', 'documentType'])
            ->where('pushed', false)
            ->get();

        if ($documents->isNotEmpty()) {
            
            $existingData = [];
            $filePath = 'src/data/data.json';

            if (Storage::disk('client')->exists($filePath)) {
                $existingData = json_decode(Storage::disk('client')->get($filePath), true);
            }

           
            $combinedData = array_merge($existingData, $documents->toArray());   
            foreach ($documents as $document) {
                $document->update(['pushed' => true]);
            } 
            Storage::disk('client')->put($filePath, json_encode($combinedData));
      
            $this->pushRepo();

        
            return redirect()->route('document');
        } else {
           
            return redirect()->route('document');
        }
    }
    protected function pushRepo()
    {

    $scriptPath = env('CLIENT_PATH') . 'deploy.sh';
    $output = exec("bash $scriptPath");
    
    \Log::info('Script Output: ' . $output);


    }
}


