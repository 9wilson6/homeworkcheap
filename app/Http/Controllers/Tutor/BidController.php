<?php

namespace App\Http\Controllers\Tutor;

use App\Bid;
use App\Client\Order;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order, User $user, Request $request)
    {
        $request->validate([
            'bid'=>'required | numeric'
        ]);
        $data['bid_amount']=$request["bid"];
        $data["order_id"]=$order->id;
        $data["tutor_id"]=$user->id;
        Bid::create($data);

        return redirect()->route("tutor.orders.show")->with("success", "bid placed successfully");
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
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        $bid=$bid->load("order");
        $file_path = 'FILES/' . $bid->order->student_id . "/" . $bid->order->id . '/';
        $files = Storage::files($file_path);
        return view ("tutor.bid.show" , compact("bid", "files"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
      $bid->delete();
        return redirect()->route("tutor.myorders.show",[Auth::id()])->with("success", "bid removed successfully");
    }
}
