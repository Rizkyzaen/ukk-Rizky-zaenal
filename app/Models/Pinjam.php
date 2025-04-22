<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id', 'user_id', 'dipinjam_date', 'kembalikan_date', 'status', 'fine' , 'cover'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function getCoverUrlAttribute()
    {
        return asset('storage/cover_buku/' . $this->cover); // Ensure this method is in the correct model
    }
}
