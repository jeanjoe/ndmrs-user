<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
  public function drug() {
    return $this->belongsTo('App\Drug');
  }
  public function StockCard() {
    return $this->belongsTo('App\StockCard');
  }
}
