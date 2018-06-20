<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
  public function drug() {
    return $this->belongsToMany('App\Drug','drug_id');
  }
}
