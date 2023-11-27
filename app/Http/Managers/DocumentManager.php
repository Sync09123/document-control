<?php

namespace App\Http\Managers;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\HasPDF;
use App\Http\Traits\HasQR;
class   DocumentManager{


    use HasPDF, HasQR;



    public function uploadDocument($request){
        $user = Auth::user();


        if ($file = $request->file('file_path')) {

            $fileExtension = $file->getClientOriginalExtension();
            $ref_id = uniqid();

            $document = Document::create([
                'user_id' => $user->id,
                'user_info_id' => $request['user_info_id'],
                'ref_id' => $ref_id,
                'path' => $ref_id,
                'document_type_id' => $request['document_type_id']

            ]);

            if ($fileExtension === 'docx') {
                $fileName = $ref_id . '.' . 'pdf';
                $content = $this->converToPDF($file, $fileName);
                $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($content, 'PDF');

                //   $PDFWriter = $this->converToPDF($file,$fileName);
                $PDFWriter->save(public_path('documents/temp/' . $fileName));

            } else {
                $fileName = $ref_id . '.' . $fileExtension;
                $file->move('documents/temp/', $fileName);
            }

            $this->generateQR($ref_id);


            $document->path = $fileName;
            $document->save();

            $outputFilePath = public_path("documents/files/" . $fileName);
            $this->fillPDFFile("documents/temp/" . $fileName, $outputFilePath, $ref_id);

        }
    }
}