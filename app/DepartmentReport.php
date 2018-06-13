<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentReport extends Model
{
    protected $table = 'department_drug_reports';

    public function issuedDrug()
    {
        return $this->belongsTo('App\IssuedDrug', 'issued_drug_id', 'id');
    }
}
