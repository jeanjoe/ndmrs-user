<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function districts()
    {
      #return Districts
      return $this->hasMany('App\District');
    }

    public function healthSubDistricts()
    {
      # code...
      return $this->hasManyThrough('App\HealthSubDistrict', 'App\District');
    }
}
