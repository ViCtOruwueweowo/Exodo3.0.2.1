<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory; 

    protected $table = 'rental';
    protected $primaryKey = 'rental_id';
    protected $fillable = ['rental_date', 'inventory_id', 'customer_id', 'return_date', 'staff_id'];

    public $timestamps = true;
    const UPDATED_AT = 'last_update';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
