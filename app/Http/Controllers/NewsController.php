<?php

namespace App\Http\Controllers;

use App\Classes\ImageProcess;
use App\Gallery;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'DESC')->limit(20)->get();

        return (view('news.index', ['news' => $news]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galleries = Gallery::all();

        return view('news.create', ['galleries' => $galleries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'title' => 'required | max:255',
            'keywords' => 'max:255',
            'cover' => 'required|image|mimes:jpg,jpeg,png,gif|max:15360',
            'gallery_id' => 'numeric|nullable',
            'video' => 'string|nullable'
        ]);
        $data['news-trixFields'] = request('news-trixFields');
        $data['cover'] = 'temp';

        $new = News::create($data);
        
        $hasFile = $request->hasFile('cover');
        if ($hasFile) {
            $file = $request->file('cover');

            $name_thumbnail = $file->store('news/thumbnail');
            $name_cover = $file->store('news/cover');
            $name_fbShareImage = $file->store('news/fbShareImage');

            $new->thumbnail = $name_thumbnail;
            $new->cover = $name_cover;
            $new->fbShareImage = $name_fbShareImage;

            $thumb = ImageProcess::image_process(Storage::path($new->thumbnail), $file->getClientOriginalExtension(), 360, 180);

            $cover = ImageProcess::image_process(Storage::path($new->cover), $file->getClientOriginalExtension(), 1000, 500);

            $fbShare = ImageProcess::image_process(Storage::path($new->fbShareImage), $file->getClientOriginalExtension(), 1200, 630);
        }

        $new->save();

        $request->session()->flash('status', 'Új hír mentve!');
        
        return redirect()->route('news.show', ['news' => $new->id]);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = News::findOrFail($id);
        $gallery = Gallery::find($new->gallery_id);

        return view('news.show', [
            'new' => $new,
            'gallery' => $gallery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::findOrFail($id);
        $galleries = Gallery::all();

        return view('news.edit', [
            'new' => $new,
            'galleries' => $galleries
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
        $oldNews = News::findOrFail($id);
        $data = $request->validate([
            'title' => 'required | max:255',
            'keywords' => 'max:255',
            'gallery_id' => 'numeric|nullable',
            'video' => 'string|nullable',
            'cover' => 'image|mimes:jpg,jpeg,png,gif|max:15360',
        ]);
        $data['news-trixFields'] = request('news-trixFields');

        $new = $oldNews->fill($data);
        
        $hasFile = $request->hasFile('cover');
        if ($hasFile) {
            $file = $request->file('cover');

            $name_thumbnail = $file->store('news/thumbnail');
            $name_cover = $file->store('news/cover');
            $name_fbShareImage = $file->store('news/fbShareImage');

            Storage::delete($new->thumbnail);
            Storage::delete($new->cover);
            Storage::delete($new->fbShareImage);

            $new->thumbnail = $name_thumbnail;
            $new->cover = $name_cover;
            $new->fbShareImage = $name_fbShareImage;

            $thumb = ImageProcess::image_process(Storage::path($new->thumbnail), $file->getClientOriginalExtension(), 360, 180);

            $cover = ImageProcess::image_process(Storage::path($new->cover), $file->getClientOriginalExtension(), 1000, 500);

            $fbShare = ImageProcess::image_process(Storage::path($new->fbShareImage), $file->getClientOriginalExtension(), 1200, 630);
        }

        $new->save();

        $request->session()->flash('status', 'Hír módosítva!');
        
        return redirect()->route('news.show', ['news' => $new->id]);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $new = News::findOrFail($id);

        if ($new->thumbnail) {
            Storage::delete($new->thumbnail);
            Storage::delete($new->cover);
            Storage::delete($new->fbShareImage);
        }

        $new->delete();

        $request->session()->flash('status', $new->title.' című hír törölve.');

        return redirect()->route('news.index');
    }
}
