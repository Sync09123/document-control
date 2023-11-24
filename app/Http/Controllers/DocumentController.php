<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class DocumentController extends Controller
{
    //


    public function index(){

        return Inertia::render('Document',[
            'create'=>route('user.create'),
            'users'=>UserInfo::all(),
            'documentType'=>DocumentType::all()
           
        ]);

    }

    public function storeType(Request $request){
        Validator::make($request->all(), [
            'name' => 'required|max:255',     
          
        ])->validate();

        DocumentType::create([
            'name'=>$request['name']
        ]);

        return to_route('document');



    }

    public function upload(Request $request){


       //return dd($request->file());


       $user = Auth::user();

      // return dd($user->id);

        

        if($file = $request->file('file_path')){


       

            $fileExtension = $file->getClientOriginalExtension();
            $ref_id = uniqid();
            $fileName = $ref_id  . '.' . $fileExtension;


            $document =Document::create([
                'user_id'=>$user->id,
                'user_info_id'=>$request['user_info_id'],
                'ref_id'=>$ref_id,
                'path'=>$ref_id,
                'document_type_id'=>$request['document_type_id']

            ]);
    
            $file->move('documents', $fileName);
    
            $document->path = $fileName;
            $document->save();

        }
    

        return to_route('document');
    }
    

    public function store(Request $request){





    }

    
}
