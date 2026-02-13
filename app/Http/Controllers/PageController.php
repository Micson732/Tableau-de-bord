<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  


class PageController extends Controller
{
    public function welcomePage(Request $request)
    { 
        if(Auth::check()){
            return redirect()->route('login');
        }
        else{
            return view('welcome');
        }
    }
}
 