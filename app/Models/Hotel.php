<?php

namespace LaravelHotel\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelHotel\Models\Comentario;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hoteles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'costo', 'estrellas', 'direccion', 'ciudad', 'calificacion'];
}
