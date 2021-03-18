<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Illuminate\Support\Facades\Storage;

class Price extends Model
{
  protected $fillable = ['name', 'price', 'current', 'people', 'parent_id', 'unit', 'description'];

  public function subPrice() {
      return $this->hasMany('App\Price', 'parent_id')->with('subPrice')->orderBy('price', 'DESC');
  }
}
