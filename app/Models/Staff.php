<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory; 

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = ['first_name', 'last_name', 'address_id', 'picture', 'email', 'store_id', 'active', 'username', 'password', 'google2fa_secret', 'google2fa_enabled'];

    public $timestamps = false;
    const UPDATED_AT = 'last_update';

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
