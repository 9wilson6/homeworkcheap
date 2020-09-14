<?php

namespace App\Http\Controllers;

use App\Client\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //file download function
    public function download(Order $order, $file)
    {
        $user_id = $order->student_id;
        $file_path = storage_path('/app/FILES/' . $user_id . "/" . $order->id . '/' . $file);
        return response()->download($file_path);
    }
}
