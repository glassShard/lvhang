<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sample;
use App\Http\Requests\StoreSample;

use Illuminate\Support\Facades\Mail;
use App\Mail\RequestForOffer;
use App\Mail\RequestForOfferToSender;
use Exception;

class SampleController extends Controller
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
        //dd($api_token);
        return Sample::with('subSample')->where('parent_id', null)->orderBy('price', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSample $request)
    {
        $data = $request->validated();

        $sample = Sample::create($data);

        if ($sample->save()) {
            return $sample;
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
        return Sample::with('subSample')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSample $request, $id)
    {
        $sample = Sample::findOrFail($id);

        $data = $request->validated();
        
        $sample->fill($data);
        
        $sample->save();
        
        return $sample;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sample = Sample::with('subSample')->findOrFail($id);

        $this->deleteSubSample($sample);

        $sample->delete();

        return response()->noContent();
    }

    private function deleteSubSample($sample)
    {
        $subSamples = $sample->subPrice;

        foreach($subSamples as $subSample) {
            $this->deleteSubPrice($subSample);

            $subSample->delete(); 
        }
    }

    public function sendRFOMail(Request $request)
    {
        $data = $request->json()->all();
        try {
            Mail::to('baranyieva@uvegszilank.hu')->send(
                new RequestForOffer($data)
            );

            Mail::to($data['email'])->send(
                new RequestForOfferToSender($data)
            );
            return json_encode('Success');
        } catch (Exception $e) {
            return json_encode($e);
        }
    }

}
