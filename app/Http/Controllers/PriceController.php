<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use Illuminate\Support\Facades\Storage;

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
/*         $prices = Price::with('subPrice')->where('parent_id', null)->orderBy('price', 'DESC')->get(); */
return view('prices.angular');
        /* return view('prices.index', compact('prices')); */
    }
    
    public function angular()
    {
        return view('prices.angular');
    }
}
