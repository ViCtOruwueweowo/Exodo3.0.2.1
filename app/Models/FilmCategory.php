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
}
