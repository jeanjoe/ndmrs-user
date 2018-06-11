<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedDrug extends Model
{
    public function drug()
    {
        return $this->belongsTo('App\Drug');
    }
}
