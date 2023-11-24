<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
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


        $file = $request->file('image');
    }

    
}
