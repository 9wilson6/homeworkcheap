<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->type === 1) {
            return redirect("admin/dashboard");
        } elseif (auth()->user()->type === 2) {

            return redirect( "client/dashboard");
        } elseif (auth()->user()->type === 3) {
            return redirect("tutor/dashboard");
        } else {
            Auth::logout();
            Session::flush();
        }
    }
}
