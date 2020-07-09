<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveRef extends Model
{
    public function liveRefPlace()
    {
        return $this->belongsTo('App\LiveRefPlace');
    }
}
