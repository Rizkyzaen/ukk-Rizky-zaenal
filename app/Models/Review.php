<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasFactory;

    protected $fillable = ['buku_id', 'user_id', 'rating', 'review'];

    public function buku()
{
    return $this->belongsTo(Buku::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
