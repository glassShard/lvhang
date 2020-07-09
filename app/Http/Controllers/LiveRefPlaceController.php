<?php

namespace App\Http\Controllers;

use App\LiveRef;
use App\LiveRefPlace;
use Illuminate\Http\Request;

class LiveRefPlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('liveReferences.liveRefPlaces.index', ['liveRefPlaces' => LiveRefPlace::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('liveReferences.liveRefPlaces.create', ['liveRefPlaces' => LiveRefPlace::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $liveRefPlace = new LiveRefPlace();
        $liveRefPlace->name = $request->input('name');
        $liveRefPlace->save();

        $request->session()->flash('status', 'Helyszín rögzítve!');
        return redirect()->route('live-ref-places.index'); 
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
        return view('liveReferences.liveRefPlaces.edit', [
            'liveRefPlaces' => LiveRefPlace::all(),
            'liveRefPlaceToEdit' => LiveRefPlace::findOrFail($id)
        ]);
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
        $liveRefPlace = LiveRefPlace::findOrFail($id);

        $liveRefPlace->name = $request->input('name');
        
        $liveRefPlace->save();

        $request->session()->flash('status', 'Helyszín módosítva!');
        return redirect()->route('live-ref-places.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $liveRefPlace = LiveRefPlace::findOrFail($id);

        LiveRef::where('live_ref_place_id', $id)->delete();

        $liveRefPlace->delete();

        $request->session()->flash('status', $liveRefPlace->name.' nevű helyszín törölve.');

        return redirect()->route('live-ref-places.index');
    }
}
