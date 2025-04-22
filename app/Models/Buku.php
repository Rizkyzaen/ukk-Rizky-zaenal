<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
    'judul',
    'penulis',
    'kategori',
    'stok',
    'cover',
];
public function reviews() {
    return $this->hasMany(Review::class);
}
public function getCoverAttribute()
{
    return $this->attributes['cover'] ?? 'default_cover.jpg';
}

}
