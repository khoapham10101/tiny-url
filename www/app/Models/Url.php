<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_url',
        'long_url',
        'hits',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
