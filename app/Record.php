<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Record extends Model
{
    use HasTrixRichText;

    protected $guarded = [];
    
    protected $fillable = ['title', 'performer', 'type', 'year', 'thumbnail', 'image', 'record-trixFields'];

    public function url($type) {
        return Storage::url($this->$type);
    }
}
