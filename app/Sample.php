<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
  protected $fillable = ['name', 'price', 'parent_id', 'description'];

  public function subSample() {
      return $this->hasMany('App\Sample', 'parent_id')->with('subSample')->orderBy('price', 'DESC');
  }
}