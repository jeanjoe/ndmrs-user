<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthSubDistrict extends Model
{
    public function district()
    {
      return $this->belongsTo('App\District');
    }

    public function healthFacilities()
    {
      # code...
      return $this->hasMany('App\HealthFacility');
    }
}
