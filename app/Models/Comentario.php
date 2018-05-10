<?php

namespace LaravelHotel\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comentarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['calificacion', 'mensaje', 'id_hotel', 'id_usuario', 'estrellas'];
}
