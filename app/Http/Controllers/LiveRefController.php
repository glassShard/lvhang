<?php

namespace App\Http\Controllers;

use App\LiveRef;
use App\LiveRefPlace;
use Illuminate\Http\Request;

class LiveRefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function liveRefList($id)
    {
        $liveRefPlace = LiveRefPlace::findOrFail($id);

        $liveRefs = $liveRefPlace->liveRefs;
        
        return view('liveReferences.liveRefs.liveRefList', [
            'liveRefPlace' => $liveRefPlace,
            'liveRefs' => $liveRefs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $liveRef = new LiveRef();
        $liveRef->performer = $request->input('performer');
        $liveRef->live_ref_place_id = $request->input('liveRefPlace');
        $liveRef->save();

        $request->session()->flash('status', 'Helyszín rögzítve!');
        return redirect()->route('live-ref-list', ['id' => $liveRef->live_ref_place_id]); 
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
        $liveRef = LiveRef::findOrFail($id);

        $liveRef->performer = $request->input('performer');
        
        $liveRef->save();

        $request->session()->flash('status', 'Előadó (referencia) módosítva!');
        return redirect()->route('live-ref-list', ['id' => $liveRef->liveRefPlace]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $liveRef = LiveRef::findOrFail($id);

        $liveRef->delete();

        $request->session()->flash('status', $liveRef->performer.' nevű előadó törölve.');

        return redirect()->route('live-ref-list', ['id' => $liveRef->liveRefPlace]);
    }
}
