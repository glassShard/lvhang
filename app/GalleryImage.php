<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    // protected $fillable = ['thumbnail', 'image', 'gallery_id'];

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }

    public function url($type) {
        return Storage::url($this->$type);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function(GalleryImage $galleryImage) {
            Storage::delete($galleryImage->thumbnail);
            Storage::delete($galleryImage->image);
        });
    }
}
