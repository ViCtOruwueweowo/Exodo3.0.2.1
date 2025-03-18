<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $table = 'customer';
    protected $primaryKey = 'customer_id'; 


    protected $fillable = [
        'store_id', 
        'first_name', 
        'last_name', 
        'email', 
        'address_id', 
        'active',
        'create_date',
    ];

    public $timestamps = false; 
    protected $dates = ['create_date', 'last_update']; 

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
