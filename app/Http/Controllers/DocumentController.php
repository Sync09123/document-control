<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
class DocumentController extends Controller
{
    //


    public function index(){

        return Inertia::render('Document',[
            'create'=>route('user.create'),
            'users'=>UserInfo::all(),
            'user'=>null
           
        ]);

    }

    
}
