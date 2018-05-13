<?php

namespace LaravelHotel\Http\Controllers;

use Illuminate\Http\Request;
use LaravelHotel\Models\Hotel;
use Illuminate\Support\Facades\DB;
use LaravelHotel\User;
use LaravelHotel\Models\Comentario;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Facades\Redirect;

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mensaje' => 'required',
        ]);

        $estrellas = $request->estrellas;
        $mensaje = $request->mensaje;
        $idHotel = $request->hotel_inv;
        $idUser = $request->usr_inv;
        $hotel = Hotel::find($idHotel);
        $calificacion = 0;
        if ($estrellas === 'Una estrella') {
            $calificacion = 1;
        } else if ($estrellas === 'Dos estrellas') {
            $calificacion = 2;
        } else if ($estrellas === 'Tres estrellas') {
            $calificacion = 3;
        } else if ($estrellas === 'Cuatro estrellas') {
            $calificacion = 4;
        } else {
            $calificacion = 5;
        }
        $cantidadComentarios = Comentario::all()->count();
        if ($cantidadComentarios === 0) {
            $hotel->calificacion = $calificacion;
            $hotel->save();
        } else {
            $suma = Comentario::all()->sum('calificacion');
            $promedio = $suma / $cantidadComentarios;
            $hotel->calificacion = $promedio;
            $hotel->save();
        }

        Comentario::create([
            'estrellas' => $estrellas,
            'calificacion' => $calificacion,
            'mensaje' => $mensaje,
            'hotel_id' => $idHotel,
            'user_id' => $idUser,
        ]);
        return Redirect::route('hoteles.show', $idHotel)->with('success', 'Mensaje agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
