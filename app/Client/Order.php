<?php

namespace App\Client;

use App\Bid;
use App\Progress;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];

   public function user(){
       return $this->belongsTo(User::class, "student_id");
   }

   public function bids(){
       return $this->hasMany(Bid::class, "order_id");
   }

    public function progress(){
        return $this->hasOne(Progress::class);
    }
}
