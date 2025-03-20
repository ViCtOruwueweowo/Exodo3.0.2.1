<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';  
    protected $primaryKey = 'city_id'; 
    public $timestamps = false; 

    protected $fillable = ['city','country_id', 'last_update'];
    

    // Relación belongsTo con Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id'); // Elimina el espacio extra después de 'country_id'
    }
}
