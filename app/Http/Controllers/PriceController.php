<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['nonexistingAuth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function angular($route)
    {
        $api_token = '';
        
        if (Auth::user()) {
            $api_token = Auth::user()->api_token;
        } else {
            if ($route === 'edit') {
                return redirect()->route('login');
            }
        }
        
        return view('prices.angular', ['user' => $api_token]);
    }

    public function nonexistingAuth()
    {
        throw new Exception('Never to get here');

    }

    public function nonexistingNoAuth()
    {
        throw new Exception('Never to get here');

    }
}
