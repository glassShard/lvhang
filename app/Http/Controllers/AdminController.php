<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin() {
        $api_token = Auth::user()->api_token;
        
        return view('admin', ['user' => $api_token]);
    }
}
