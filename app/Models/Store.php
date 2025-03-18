<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // Definir el nombre de la tabla (si es necesario)
    protected $table = 'store';
    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'store_id';

    protected $fillable = ['manager_staff_id', 'address_id'];
    public $timestamps = false; // Si no tienes las columnas 'created_at' y 'updated_at'
}
