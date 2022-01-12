<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYC extends Model
{
    use HasFactory;


    public $fillable = [
        'user_id',
        'photo',
        'front',
        'back',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}