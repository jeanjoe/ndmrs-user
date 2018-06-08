<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    public function cycles()
    {
        return $this->hasMany('App\Cycle');
    }
}
