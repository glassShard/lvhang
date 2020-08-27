<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class News extends Model
{
    use HasTrixRichText;
    
    protected $fillable = ['title', 'cover', 'thumbnail', 'fbShareImage', 'video', 'gallery_id', 'keywords', 'news-trixFields'];

    public function url($type) {
        return Storage::url($this->$type);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function(News $news) {

            if ($news->trixRichText) {
                foreach($news->trixRichText as $text) {
                    $text->delete();
                }
            }
        });
    }
}
