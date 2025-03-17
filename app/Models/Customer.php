<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    public $timestamps = false; // Si no hay created_at y updated_at

    protected $fillable = [
        'store_id', 'first_name', 'last_name', 'email', 
        'address_id', 'active', 'create_date', 'last_update'
    ];
}
