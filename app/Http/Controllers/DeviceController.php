<?php

namespace App\Http\Controllers;

use App\Classes\ImageProcess;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
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
        $parentDevices = Device::where('parent_id', null)->get();

        return view('devices.index', compact('parentDevices'));
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


    public function createToParent(Request $request, $parentId)
    {
        $parent = Device::findOrFail($parentId);

        $imageNeeded = false;

        if (isset($parent)) {
            if ($parent->parent_id === null) {
                $imageNeeded = true;
            }
        }
        
        return view('devices.createToParent', [
            'parent' => $parent,
            'imageNeeded' => $imageNeeded
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
        // Nincs store method, mert több fő eszközt nem lehet felvenni. Több fő eszköz megjelenítéséhez nincs is hely.
    }

    public function storeToParent(Request $request, $parentId)
    {
    
        $data = $request->validate([
            'name' => 'required|min:1|max:500',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:15360'
        ]);

        $parent = Device::findOrfail($parentId);
        
        $device = new Device();
        $device->name = $data['name'];
        $device->parent_id = $parent->id;
        
        $hasFile = $request->hasFile('image');
        
        if ($hasFile) {
            $file = $request->file('image');

            $name_image = $file->store('devices/image');

            $device->image = $name_image;

            $thumb = ImageProcess::image_process(Storage::path($device->image), $file->getClientOriginalExtension(), 1920, 300);
        }

        $device->save();

        $request->session()->flash('status', 'Eszköz rögzítve!');
        
        return redirect()->route('devices.index'); 
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
        $device = Device::findOrFail($id);
        $parent = Device::find($device->parent_id);
        
        $imageNeeded = false;

        if (isset($parent)) {
            if ($parent->parent_id === null) {
                $imageNeeded = true;
            }
        }
        
        return view('devices.edit', [
            'device' => $device,
            'imageNeeded' => $imageNeeded
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
        $device = Device::findOrFail($id);
    
        $data = $request->validate([
            'name' => 'required|min:1|max:500',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:15360'
        ]);

        
        $device->name = $data['name'];
        
        $hasFile = $request->hasFile('image');
        
        if ($hasFile) {
            $file = $request->file('image');

            $name_image = $file->store('devices/image');

            Storage::delete($device->image);
            $device->image = $name_image;

            $thumb = ImageProcess::image_process(Storage::path($device->image), $file->getClientOriginalExtension(), 1920, 300);
        }

        $device->save();

        $request->session()->flash('status', 'Eszköz rögzítve!');
        
        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $this->deleteChildren($id);
        
        $device->delete();

        $request->session()->flash('status', 'Eszköz(ök) törölve!');
        
        return redirect()->route('devices.index');
    }

    private function deleteChildren($parentId)
    {
        $devices = Device::where('parent_id', $parentId)->get();
        foreach ($devices as $device) {
            $this->deleteChildren($device->id);
            Storage::delete($device->image);
            $device->delete();
        }
    }
}
