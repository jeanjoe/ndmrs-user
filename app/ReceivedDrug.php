<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivedDrug extends Model
{
    public function drug()
    {
        return $this->belongsTo('App\Drug');
    }

    public function stockBook()
    {
        return $this->belongsTo('App\StockBook', 'stock_book_id', 'id');
    }

    public function drugs()
    {
        return $this->hasMany('App\ReceivedDrug', 'receive_date', 'receive_date');
    }

}
