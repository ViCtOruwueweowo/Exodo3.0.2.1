<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Define el nombre de la tabla (si es necesario)
    protected $table = 'payment';
    
    // Define la clave primaria
    protected $primaryKey = 'payment_id';

    // Deshabilitar el uso de timestamps
    public $timestamps = false;

    // Especifica las columnas que son asignables masivamente
    protected $fillable = [
        'customer_id',
        'staff_id',
        'rental_id',
        'amount',
        'payment_date',
    ];

    // Relación de muchos a uno con Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relación de muchos a uno con Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Relación de uno a uno con Rental
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
