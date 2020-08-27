<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Record extends Model
{
    use HasTrixRichText;

    protected $guarded = [];
    
    protected $fillable = ['title', 'performer', 'type', 'year', 'thumbnail', 'image', 'record-trixFields', 'fbShareImage', 'keywords'];

    public function url($type) {
        return Storage::url($this->$type);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function(Record $record) {
            if ($record->thumbnail) {
                Storage::delete($record->thumbnail);
                Storage::delete($record->image);
                Storage::delete($record->fbShareImage);
            }
            if ($record->trixRichText) {
                foreach($record->trixRichText as $text) {
                    $text->delete();
                }
            }
        });
    }
}
