<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function contact() {
        return view('contact');
    }

    public function record($id) {
        $albums = [
            1 => ['title' => 'hello from album 1'],
            2 => ['title' => 'hello from album 2']
        ];
        return view('record', ['data' => $albums[$id]]);
    }
}

        
