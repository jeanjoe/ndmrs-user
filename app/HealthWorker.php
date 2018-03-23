<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthWorker extends Model
{
    public function healthFacility()
    {
      # code...
      return $this->belongsTo('App\HealthFacility');
    }
}
