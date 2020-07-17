<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Device extends Model
{
    protected $fillable = ['name'];
    
    public function subDevice() {
        return $this->hasMany('App\Device', 'parent_id');
    }

    public function url($type) {
        return Storage::url($this->$type);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function(Device $device) {
            Storage::delete($device->image);
        });
    }
}
