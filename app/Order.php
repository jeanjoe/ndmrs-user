<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function healthFacility()
  {
      return $this->belongsTo('App\HealthFacility');
  }

  public function orderLists()
  {
      return $this->belongsTo('App\OrderList', 'order_code' ,'commit_code');
  }

  public function healthWorker()
  {
      return $this->belongsTo('App\HealthWorker', 'health_worker_id');
  }
}
