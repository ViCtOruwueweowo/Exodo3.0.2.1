<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'film';
    protected $primaryKey = 'film_id';
    public $timestamps = false; // No usa created_at y updated_at

    protected $fillable = [
        'title', 'description', 'release_year', 'language_id',
        'original_language_id', 'rental_duration', 'rental_rate',
        'length', 'replacement_cost', 'rating', 'special_features', 'last_update'
    ];
}
