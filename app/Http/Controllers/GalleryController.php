<?php

namespace App\Http\Controllers;

use App\Classes\ImageProcess;
use App\Gallery;
use App\GalleryImage;
use App\Rules\GalleryImagesRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'galleriesByType']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('galleries.index', ['galleries' => Gallery::all()]);
    }

    public function galleriesByType($type)
    {
        if ($type === 'live') {
            return view('galleries.galleriesByType', [
                'galleries' => Gallery::where('foot', 'live')->get(),
                'type' => 'élő']);
        }
        elseif ($type === 'news') {
            return view('galleries.galleriesByType', [
                'galleries' => Gallery::where('foot', 'news')->get(),
                'type' => 'hírek']);
        }
        else {
            return view('galleries.galleriesByType', [
                'galleries' => Gallery::where('foot', 'studio')->get(),
                'type' => 'studio']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($studio=0)
    {
        return view('galleries.create', ['studio' => $studio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:4000',
            'foot' => 'required',
            'ref' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);

        if (isset($data['ref'])) {
            if ($data['ref'] === 'true') {
                $data['ref'] = true;
            }
        } else {
            $data['ref'] = false;
        }

        $gallery = Gallery::create($data);
        
        $hasFile = $request->hasFile('image');
        
        if ($hasFile) {
            $file = $request->file('image');

            $name_thumbnail = $file->store('galleries/thumbnail');
            $name_fbShareImage = $file->store('galleries/fbShareImage');

            $gallery->thumbnail = $name_thumbnail;
            $gallery->fbShareImage = $name_fbShareImage;

            $thumb = ImageProcess::image_process(Storage::path($gallery->thumbnail), $file->getClientOriginalExtension(), 300, 300);

            $fbShare = ImageProcess::image_process(Storage::path($gallery->fbShareImage), $file->getClientOriginalExtension(), 1200, 630);
        }

        $gallery->save();

        $request->session()->flash('status', 'Új galéria mentve!');
        
        return redirect()->route('galleries.show', ['gallery' => $gallery->id]);   
    }

    public function saveImages(Request $request, $id) {
        
        $data = $request->validate([
            'images' => new GalleryImagesRule,
        ]);
        
        $hasFiles = $request->hasFile('images');
        
        $gallery = Gallery::find($id);

        if ($hasFiles) {
            $files = $request->file('images');

            foreach($files as $file) {
                $name_thumbnail = $file->store('gallery-images/thumbnail');
                $name_image = $file->store('gallery-images/image');

                $gallery_image = new GalleryImage();

                $gallery_image->thumbnail = $name_thumbnail;
                $gallery_image->image = $name_image;

                $thumb = ImageProcess::image_process(Storage::path($gallery_image->thumbnail), $file->getClientOriginalExtension(), 'auto', 250);

                $image = ImageProcess::image_process(Storage::path($gallery_image->image), $file->getClientOriginalExtension(), 'max', 1920);
                
                $gallery->galleryImages()->save($gallery_image);
            }
            
            $request->session()->flash('status', 'Képek mentve!');
        }

        return redirect()->route('galleries.show', ['gallery' => $gallery->id]);
    }

    public function deleteImages(Request $request, $id) {
        $image = GalleryImage::findOrFail($id);

        $galleryId = $image->gallery;

        $image->delete();

        $request->session()->flash('status', 'Kép törölve.');

        return redirect()->route('galleries.show', ['gallery' => $galleryId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->galleryImages();
       // dd($gallery);
        return view('galleries.show',  ['gallery' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        return view('galleries.edit', ['gallery' => $gallery]);
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
        
        $data = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:16384',
            'foot' => 'required',
            'ref' => 'string|nullable',
            'keywords' => 'string|nullable'
        ]);

        if (isset($data['ref'])) {
            if ($data['ref'] === 'true') {
                $data['ref'] = true;
            }
        } else {
            $data['ref'] = false;
        }
        

        $gallery = Gallery::findOrfail($id);

        $gallery->fill($data);
        
        $hasFile = $request->hasFile('image');
        
        if ($hasFile) {
            $file = $request->file('image');

            $name_thumbnail = $file->store('galleries/thumbnail');
            $name_fbShareImage = $file->store('galleries/fbShareImage');

            Storage::delete($gallery->thumbnail);
            Storage::delete($gallery->fbShareImage);

            $gallery->thumbnail = $name_thumbnail;
            $gallery->fbShareImage = $name_fbShareImage;

            $thumb = ImageProcess::image_process(Storage::path($gallery->thumbnail), $file->getClientOriginalExtension(), 300, 300);

            $fbShare = ImageProcess::image_process(Storage::path($gallery->fbShareImage), $file->getClientOriginalExtension(), 1200, 630);
        }

        $gallery->save();

        $request->session()->flash('status', 'Galéria módosítva!');
        
        return redirect()->route('galleries.show', ['gallery' => $gallery->id]);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $galleryImages = $gallery->galleryImages;

        foreach ($galleryImages as $galleryImage) {
            Storage::delete($galleryImage->thumbnail);
            Storage::delete($galleryImage->image);
        }

        $gallery->delete();

        $request->session()->flash('status', $gallery->title.' című galéria törölve.');

        return redirect()->route('galleries.index');
    }
}
