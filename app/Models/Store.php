<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';
    protected $primaryKey = 'store_id';
    protected $fillable = ['manager_staff_id', 'address_id'];

    public $timestamps = true;
    const UPDATED_AT = 'last_update';

    public function managerStaff()
    {
        return $this->belongsTo(Staff::class, 'manager_staff_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'store_id');
    }
}
