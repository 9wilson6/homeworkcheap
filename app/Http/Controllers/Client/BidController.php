<?php

namespace App\Http\Controllers\Client;

use App\Bid;
use App\Client\Order;
use App\Http\Controllers\Controller;
use App\Progress;
use App\User;
use Illuminate\Support\Facades\Auth;


class BidController extends Controller
{
    public function award(Order $order, User $user, Bid $bid){
        Progress::create(["order_id"=>$order->id, "user_id"=>$user->id]);
        Order::where('id', $order->id)->update(array('status' => 2));
        Bid::destroy($bid->id);
        return redirect()->route('client.orders.show', ['user' => Auth::id()])->with("success", "Order awarded successfuly");
    }
}
