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
    protected $fillable = ['calificacion', 'mensaje', 'hotel_id', 'user_id', 'estrellas'];

    public function user()
    {
        return $this->belongsTo('LaravelHotel\User');
    }

    public function hotel()
    {
        return $this->belongsTo('LaravelHotel\Models\Hotel');
    }
}
