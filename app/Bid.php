<?php

namespace App;

use App\Client\Order;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded=[];
    public function order(){
        return $this->belongsTo(Order::Class, "order_id");
    }

    public function user(){
        return $this->belongsTo(User::Class, "tutor_id");
    }
}
