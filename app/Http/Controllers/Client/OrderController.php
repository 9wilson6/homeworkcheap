<?php

namespace App\Http\Controllers\Client;

use App\Client\Order;
use App\Http\Controllers\Controller;
use App\Progress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Custom\EncryptionHandler;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidding = auth()->user()->orders->where("status",1)->count();
        $progress = auth()->user()->orders->where("status",2)->count();
        return view("client.dashboard", compact("bidding", "progress"))->with("success", "welcome home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("client.order.new");
    }

    /**
     * Store a newly created resource in storage.
     * artisan
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $data = $this->validator($request);
        $this->validateFiles($request);
        $order_id = $user->orders()->create($data)->id;
        $user_id = Auth::user()->id;
        $this->filesHandler($user_id, $order_id, $request);
        return redirect()->route("client.orders.show", [$user_id])->with("success", "Order published successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function getOrders(User $user)
    {
        $orders =  $user->orders()->with("bids")->where("status", 1)->paginate(10);
        $progress=$user->orders()->where("status", 2)->with("progress")->paginate(10);

        return view("client.order.get", compact("orders", "progress"));
    }
    public function show(Order $order)
    {
        $user_id = Auth::user()->id;
        $order_id = $order->id;
        $file_path = 'FILES/' . $user_id . "/" . $order_id . '/';
        $files = Storage::files($file_path);
        $bid_info=$order->load("bids");
        $bid_info= $bid_info->bids()->with("user")->get();
        return view("client.order.show", compact('order', "files", "bid_info"));
    }

    /**
     * file delete function for client
     *
     * */
    public function delete(Order $order, $file)
    {
        $user_id = Auth::user()->id;
        $file_path = storage_path('app/FILES/'. $user_id ."/". $order->id."/".$file);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        return redirect()->route("client.order.show", [$order->id])->with("success", "File deleted successfully");
    }

    /**
     * additional material upload
     *
     */
    public function additional(Request $request, Order $order)
    {

        $this->validateFiles($request);
        $this->filesHandler(Auth::user()->id, $order->id, $request);
        return redirect()->route("client.order.show", [$order->id])->with("success", "File(s) uploaded successfully");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Order $order)
    {
        return view("client.order.edit", compact("order"));
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
        $data = $this->validator($request);

        $order->update($data);
        return redirect()->route("client.order.show", [$order->id])->with("success", "Order updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

        $user_id = Auth::user()->id;
        $file_path = storage_path('/app/FILES/' . $user_id . "/" . $order->id . "/");
        if (is_dir($file_path)) {
            File::deleteDirectory($file_path);
        }
        $order->destroy($order->id);
        return redirect()->route("client.orders.show", [$user_id])->with("success", "Order deleted successfully");
    }

    /**
     *rename file
     */
    private function  clean($filename)
    {

        return preg_replace('/[^A-Za-z0-9.-]/', '_', $filename); // Removes special chars.
    }
    private function validator($request)
    {
        $data = $request->validate(
            [
                'paper_type' => "required",
                'topic' => "required",
                'pages' => "required|numeric",
                'budget' => "required|numeric",
                "deadline" => "required",
                'discipline' => "required",
                'service_type' => "required",
                "format" => "required",
                "instructions" => "required",
                "writer" => "nullable|numeric"
            ]
        );
        $data["deadline"] = date("Y:m:d H:i:s", strtotime($data["deadline"]));
        return $data;
    }

    private function filesHandler($user_id, $order_id, $request)
    {

        if ($request->hasFile("myfiles")) {
            foreach ($request->myfiles as $file) {

                $filename = $this->clean($file->getClientOriginalName());

                $file->storeAs('FILES/' . $user_id . "/" . $order_id, $filename);
            }
        }
    }
    private function validateFiles($request)
    {

        $request->validate([
            'myfiles.*' => 'sometimes|mimes:ppt,pptx,doc,docx,pdf,xls,csv,xlsx,txt,html,jpeg,png,jpg,gif,svg|max:10240',
        ], $messages = [
            "max" => 'Max file size exceeded. Max size limit per file should be 10MB',
            'mimes' => 'You can only upload .ppt, .pptx, .doc, csv, .docx, .pdf, .xls, .xlsx, .jpeg, .png, .jpg, .gif, and .svg files.'
        ]);
    }
}
