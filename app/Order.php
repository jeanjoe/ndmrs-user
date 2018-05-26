<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function drug()
    {
      # code...
      return $this->belongsTo('App\Drug', 'drug_id', 'id');
    }
}
