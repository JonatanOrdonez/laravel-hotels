<?php

namespace LaravelHotel\Http\Controllers;

use Illuminate\Http\Request;
use LaravelHotel\Models\Hotel;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoteles = Hotel::all();
        return view('home')->with('hoteles', $hoteles);
    }
}
