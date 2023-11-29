<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class DashboardController extends Controller
{
    //

    public function index(){


        return Inertia::render('Dashboard' ,[
            'user'=>Auth::user(),
            'user_count'=>  UserInfo::count(),
            'document_count'=>DocumentType::count(),
            'request_today'=>Document::whereDate('created_at',Carbon::now())->count(),
            'request_month'=> Document::whereMonth('created_at',Carbon::now())->count()

        ]);
    }
}
