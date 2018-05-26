<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function drug()
    {
      # code...
      return $this->belongsTo('App\Drug');
    }
}
