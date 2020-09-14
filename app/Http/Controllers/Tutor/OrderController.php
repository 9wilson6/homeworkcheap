<?php

namespace App\Http\Controllers\Tutor;

use App\Bid;
use App\Client\Order;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidding = User::where("user_id", Auth::id())->with("bids")->count();
        $available=Order::where("status", 1)->count();
        $progress = "loading....";
        return view("tutor.dashboard", compact("bidding",  "progress", "available"));
//        $bids=Bid::where("tutor_id", Auth::user()->id)->count();
//        dd($bids);
    }
    /**
     * Get all orders in status bidding.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        $bids=Bid::all("order_id");

        $orders= Order::where("status", 1)->whereNotIn("id",$bids)->with('user')->paginate(10);

        return view("tutor.order.get", compact("orders"));
    }
    /**
     * Get all orders that already belongs to a given user.
     *
     * @return \Illuminate\Http\Response
     */
    public function myorders(User $user){
        $bids=Bid::where("tutor_id", $user->id)->with("order")->with("user")->paginate(10);
       return view("tutor.order.myorders", compact("bids"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
       $student_id=$order->student_id;
       $order_id=$order->id;
        $file_path = 'FILES/' . $student_id . "/" . $order_id . '/';
        $files = Storage::files($file_path);

       return view("tutor.order.show", compact("order", "files"));
    }
//file download function
    public function download(Order $order, $file)
    {
        $user_id = $order->id;
        $file_path = storage_path('/app/FILES/' . $user_id . "/" . $order->id . '/' . $file);
        return response()->download($file_path);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
