<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Stock() {
      return $this->belongsTo('App\StockController');
    }
}
