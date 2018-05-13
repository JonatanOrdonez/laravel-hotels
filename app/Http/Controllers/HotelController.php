<?php

namespace LaravelHotel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Couchbase\SearchQuery;
use Illuminate\Http\Request;
use LaravelHotel\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request -> nombre;
        $radio = $request -> radio;
        if(is_null($nombre)){
            $hoteles =DB::table('hoteles')->paginate(5);
            return view('hoteles.inicio')->with('hoteles', $hoteles);
        }
        elseif (is_null($radio)){
            $hoteles = DB::table('hoteles')->where('ciudad', 'LIKE',"%$nombre%")->orderBy('id', 'DESC')->paginate(5);
            return view('hoteles.inicio')->with('hoteles', $hoteles);
        }
        else{
            $hoteles = DB::table('hoteles')->where('nombre', 'LIKE',"%$nombre%")->orderBy('id', 'DESC')->paginate(5);
            return view('hoteles.inicio')->with('hoteles', $hoteles);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hoteles.createHotel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'costo' => 'required|numeric|between:1,999999999',
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        Hotel::create([
            'nombre' => $request -> input('nombre'),
            'costo' => $request -> input('costo'),
            'estrellas' => $request -> input('estrellas'),
            'direccion' => $request -> input('direccion'),
            'ciudad' => $request -> input('ciudad'),
            'calificacion' => 0,
        ]);
        return view('hoteles.successHotel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);
        return view('hoteles.showHotel')->with('hotel', $hotel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
