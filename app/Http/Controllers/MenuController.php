<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    public function menu()
    {
        //
        if (Auth::check()) {
            $company_id = Auth::user()->company_id;
            return view('receiptinfo/menu', compact('company_id'));
        } else {
            return view('auth/login');
        }
    }
}
