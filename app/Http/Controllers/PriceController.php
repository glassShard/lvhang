<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'angular']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $api_token = Auth::user()->api_token;
        
        return view('prices.angular', ['user' => $api_token]);
        /* return view('prices.index', compact('prices')); */
    }
    
    public function angular()
    {
        $api_token = Auth::user()->api_token;
        return view('prices.angular', ['user' => $api_token]);
    }
}
