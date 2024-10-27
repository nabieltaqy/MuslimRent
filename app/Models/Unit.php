<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable =[
        'nama_unit',
        'qty',
        'kode_unit',
    ];

     // Relasi many-to-many dengan kategori
     public function categories()
     {
         return $this->belongsToMany(Category::class, 'category_unit')
                     ->withTimestamps();
     }

     public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
