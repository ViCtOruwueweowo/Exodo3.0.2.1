<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla (si es necesario)
    protected $table = 'inventory';
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'inventory_id';

    protected $fillable = ['store_id', 'film_id'];
    public $timestamps = false; // Si no tienes las columnas 'created_at' y 'updated_at'

    // Relación belongsTo con Film
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id'); // 'film_id' es el nombre del campo en la tabla `inventory` que hace referencia a `film`
    }
}
