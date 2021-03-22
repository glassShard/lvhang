<?php

namespace App\Http\Controllers;

use App\Mail\RequestForOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function contact() {
        return view('contact');
    }
}

        
