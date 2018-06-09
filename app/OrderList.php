<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    public function drug()
    {
        return $this->belongsTo('App\Drug');
    }

    public function cycle()
    {
        return $this->belongsTo('App\Cycle');
    }

    public function user()
    {
        return $this->belongsTo('App\HealthWorker', 'user_id');
    }
}
