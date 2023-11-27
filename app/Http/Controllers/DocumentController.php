<?php

namespace App\Http\Controllers;

use App\Http\Managers\DocumentManager;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

use PDF;

class DocumentController extends Controller
{
    //



    protected DocumentManager $manager;
    public function __construct(DocumentManager $manager){
        $this->manager = $manager;
    }


    public function index()
    {

        return Inertia::render('Document', [

            'users' => UserInfo::all(),
            'documentType' => DocumentType::all(),
            'documents' => Document::with(['user', 'userInfo', 'documentType'])->get()

        ]);

    }


    public function storeType(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',

        ])->validate();

        DocumentType::create([
            'name' => $request['name']
        ]);

        return to_route('document');



    }

    public function upload(Request $request)
    {


        $this->manager->uploadDocument($request);

        return to_route('document');
    }


    public function showDocument(string $id)
    {


        $document = Document::find($id);


        return response()->file('documents/files/' . $document->path);



    }


}
