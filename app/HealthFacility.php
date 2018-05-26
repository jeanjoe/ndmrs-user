<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    public function healthSubDistrict ()
    {
      # code...
      return $this->belongsTo('App\HealthSubDistrict', 'health_sub_district_id', 'id');
    }
}
