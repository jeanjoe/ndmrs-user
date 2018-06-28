<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivedDrug extends Model
{
  //use SoftDeletes;

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

  public function quantity()
  {
      return $this->hasMany('App\ReceivedDrug', 'drug_id', 'drug_id');
  }

  public function quantity_remaining()
  {
      return $this->hasMany('App\ReceivedDrug', 'drug_id', 'drug_id');
  }

}
