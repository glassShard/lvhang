<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = ['title', 'foot', 'ref', 'thumbnail'];

    public function url($type) {
        return Storage::url($this->$type);
    }

    public function galleryImages()
    {
        return $this->hasMany('App\GalleryImage');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function(Gallery $gallery) {
            Storage::delete($gallery->thumbnail);
            
            $gallery->galleryImages()->delete();
        });
    }
}
