<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //

    public function store(Request $request){

     Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date',
          
        ])->validate();




        $user = UserInfo::create([
            'firstname'=>$request['firstname'],
            'lastname'=>$request['lastname'],
            'middlename'=>$request['middlename'],
            'birthdate'=>$request['birthdate'],
            'contact'=>$request['contact'],
            'address'=>$request['address']]
        );

      

       return to_route('document');

      return Inertia::render('Document',['user'=>$user]);




    }
}
