<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function region() {
      return $this->belongsTo('App\Region');
    }

    public function healthFacilities() {
      return $this->hasManyThrough('App\HealthFacility', 'App\HealthSubDistrict');
    }

    public function healthSubDistricts() {
      return $this->hasMany('App\HealthSubDistrict');
    }
}
