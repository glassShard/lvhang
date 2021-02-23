<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrice;
use Illuminate\Http\Request;
use App\Price;
use App\Record;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Price::with('subPrice')->where('parent_id', null)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrice $request)
    {
        $data = $request->validated();
        //dd($data);

        $price = Price::create($data);

        if ($price->save()) {
            return $price;
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return Price::with('subPrice')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePrice $request, $id)
    {
        $price = Price::findOrFail($id);

        $data = $request->validated();
        
        $price->fill($data);
        
        $price->save();
        
        return $price;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::with('subPrice')->findOrFail($id);

        $this->deleteSubPrice($price);

        $price->delete();

        return response()->noContent();
    }

    private function deleteSubPrice($price)
    {
        $subPrices = $price->subPrice;

        foreach($subPrices as $subPrice) {
            $this->deleteSubPrice($subPrice);

            $subPrice->delete(); 
        }
    }
}
