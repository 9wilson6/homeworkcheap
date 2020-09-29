<?php

namespace App\Http\Controllers\Tutor;

use App\Bid;
use App\Client\Order;
use App\Http\Controllers\Controller;
use App\Progress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //        $bidding = User::where("user_id", Auth::id())->with("bids")->count();
        $bids = Bid::where("tutor_id", Auth::id())->get();
        $bidding = $bids->count();
        $available = Order::all()->whereNotIn("id", $bids->pluck("order_id"))->where("status", 1)->count();
        $progress = Progress::where("user_id", Auth::id())->count();
        return view("tutor.dashboard", compact("bidding",  "progress", "available"));
    }
}
