<?php

namespace LaravelHotel\Http\Controllers;

use Illuminate\Http\Request;
use LaravelHotel\Models\Hotel;
use Illuminate\Support\Facades\DB;
use LaravelHotel\User;
use LaravelHotel\Models\Comentario;
use phpDocumentor\Reflection\Types\Integer;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'mensaje' => 'required',
        ]);

        $estrellas = $request -> estrellas;
        $mensaje = $request -> mensaje;
        $idHotel = $request -> hotel_inv;
        $idUser = $request -> usr_inv;
        $hotel = Hotel::find($idHotel);
        $calificacion = 0;
        if($estrellas === 'Una estrella'){
            $calificacion = 1;
        }
        else if($estrellas === 'Dos estrellas'){
            $calificacion = 2;
        }
        else if($estrellas === 'Tres estrellas'){
            $calificacion = 3;
        }
        else if($estrellas === 'Cuatro estrellas'){
            $calificacion = 4;
        }
        else{
            $calificacion = 5;
        }
        $numComentarios = DB::table('comentarios')->where('id_hotel', $idHotel)->count();
        if($numComentarios === 0){
            $hotel -> calificacion = $calificacion;
            $hotel -> save();
        }else{
            $miCalificacion = $hotel -> calificacion;
            $nuevaCalificacion = ($calificacion + $miCalificacion) / 2;
            $hotel -> calificacion = $nuevaCalificacion;
            $hotel -> save();
        }
        Comentario::create([
            'estrellas' => $estrellas,
            'calificacion' => $calificacion,
            'mensaje' => $mensaje,
            'id_hotel' => $idHotel,
            'id_usuario' => $idUser,
        ]);

        $comentarios = DB::table('comentarios')->where('id_hotel', $idHotel)->orderBy('id', 'DESC')->paginate(5);
        foreach ($comentarios as $comentario){
            $comentario -> correo = User::find($comentario -> id_usuario) -> email;
        }
        return view('hoteles.showHotel')->with('hotel', $hotel)->with('comentarios', $comentarios);

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
        $comentarios = DB::table('comentarios')->where('id_hotel', $id)->orderBy('id', 'DESC')->paginate(5);
        foreach ($comentarios as $comentario){
            $comentario -> correo = User::find($comentario -> id_usuario) -> email;
        }
        return view('hoteles.showHotel')->with('hotel', $hotel)->with('comentarios', $comentarios);
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
}
