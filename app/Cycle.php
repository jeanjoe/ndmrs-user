<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    public function financialYear()
    {
        return $this->belongsTo('App\FinancialYear');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
