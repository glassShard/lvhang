<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  protected $fillable = ['name', 'price', 'current', 'people', 'parent_id', 'unit', 'description'];

  public function subPrice() {
      return $this->hasMany('App\Price', 'parent_id')->with('subPrice')->orderBy('price', 'DESC');
  }
}
