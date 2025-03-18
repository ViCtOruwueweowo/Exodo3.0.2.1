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
    protected $fillable = ['address', 'address2','distric','city_id','postal_code', 'last_update'];

}
