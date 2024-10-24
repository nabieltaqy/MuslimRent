<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'category_unit');
    }
}
