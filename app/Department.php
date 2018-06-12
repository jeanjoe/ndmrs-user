<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function issueDrugs()
    {
        return $this->hasMany('App\IssuedDrug', 'department_id');
    }
}
