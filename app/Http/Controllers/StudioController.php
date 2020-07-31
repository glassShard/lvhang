<?php

namespace App\Http\Controllers;

use App\Device;
use App\Gallery;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentDevices = Device::where('id', 2)->with('subDevice')->get();

        $galleries = Gallery::where([
            ['foot', '=', 'studio'],
            ['ref', '=', 0]
        ])->inRandomOrder()->limit(4)->get();
        //dd($galleries);

        $referenceGalleries = Gallery::where([
            ['foot', '=', 'studio'],
            ['ref', '=', 1]
        ])->orderBy('created_at')->get();

        //dd($referenceGalleries);

        return view('studio', [
            'galleries' => $galleries,
            'parentDevices' => $parentDevices,
            'referenceGalleries' => $referenceGalleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
