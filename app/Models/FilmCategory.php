<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCategory extends Model
{
    use HasFactory;

    protected $table = 'film_category';
    public $timestamps = false; // No usa created_at y updated_at

    protected $fillable = [
        'film_id', 'category_id', 'last_update'
    ];

    // Relación con Film (un FilmCategory pertenece a un Film)
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    // Relación con Category (un FilmCategory pertenece a una Category)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
