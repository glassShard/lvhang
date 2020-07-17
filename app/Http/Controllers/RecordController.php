<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\Http\Requests\StoreRecords;
use App\Classes\ImageProcess;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('records.index', ['records' => Record::all()->sortByDesc('year')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecords $request)
    {
        $data = $request->validated();
        $data['record-trixFields'] = request('record-trixFields');

        $record = Record::create($data);
        
        $hasFile = $request->hasFile('image');
        if ($hasFile) {
            $file = $request->file('image');

            $name_thumbnail = $file->store('records/thumbnail');
            $name_image = $file->store('records/image');

            $record->thumbnail = $name_thumbnail;
            $record->image = $name_image;

            $thumb = ImageProcess::image_process(Storage::path($record->thumbnail), $file->getClientOriginalExtension(), 250, 250);

            $image = ImageProcess::image_process(Storage::path($record->image), $file->getClientOriginalExtension(), 1000, 1000);
        }

        $record->save();

        $request->session()->flash('status', 'Új kiadvány mentve!');
        
        return redirect()->route('records.show', ['record' => $record->id]);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('records.show', ['record' => Record::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Record::findOrFail($id);
        return view('records.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRecords $request, $id)
    {
        $record = Record::findOrFail($id);

        $data = $request->validated();
        $data['record-trixFields'] = request('record-trixFields');

        $record ->fill($data);
        
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name_thumbnail = $file->store('records/thumbnail');
            $name_image = $file->store('records/image');

            Storage::delete($record->thumbnail);
            storage::delete($record->image);

            $record->thumbnail = $name_thumbnail;
            $record->image = $name_image;

            $thumb = ImageProcess::image_process(Storage::path($record->thumbnail), $file->getClientOriginalExtension(), 250, 250);

            $image = ImageProcess::image_process(Storage::path($record->image), $file->getClientOriginalExtension(), 1000, 1000);
        }

        $record->save();

        $request->session()->flash('status', 'Kiadvány módosítva!');
        return redirect()->route('records.show', ['record' => $record->id]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $record = Record::findOrFail($id);

        if ($record->thumbnail) {
            Storage::delete($record->thumbnail);
            storage::delete($record->image);
        }

        $record->delete();

        $request->session()->flash('status', $record->name.' című kiadvány törölve.');

        return redirect()->route('records.index');
    }

}
