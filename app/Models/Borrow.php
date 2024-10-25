<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'unit_id',
        'status',
        'qty',
        'borrow_date',
        'return_date',
        'status',
        'actual_return_date',
        'penalty',
        'updated_by',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
