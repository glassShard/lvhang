<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveRefPlace extends Model
{
    protected $fillable = ['name'];

    public function liveRefs()
    {
        return $this->hasMany('App\LiveRef');
    }
}
