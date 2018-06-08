<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBook extends Model
{
    public function healthWorker()
    {
        return $this->belongsTo('App\HealthWorker', 'health_worker_id', 'id');
    }

    public function healthFacility()
    {
        return $this->belongsTo('App\HealthFacility', 'health_facility_id', 'id');
    }

    public function receivedDrugs()
    {
        return $this->hasMany('App\ReceivedDrug');
    }
}
