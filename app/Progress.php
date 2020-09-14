<?php

namespace App;

use App\Client\Order;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
   protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
