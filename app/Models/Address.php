<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $primaryKey = 'address_id';
    public $timestamps = false; 
    protected $fillable = ['address', 'address2','district','city_id','postal_code','phone', 'last_update'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id'); // Relación con la ciudad
    }

    // Relación inversa con los clientes (si deseas obtener los clientes relacionados)
    public function customers()
    {
        return $this->hasMany(Customer::class, 'address_id'); // Relación con los clientes
    }

}
