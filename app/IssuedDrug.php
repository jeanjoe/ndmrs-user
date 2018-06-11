<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuedDrug extends Model
{
    public function healthWorker()
    {
        return $this->belongsTo('App\User', 'health_worker_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function drug()
    {
        return $this->belongsTo('App\Drug');
    }
}
