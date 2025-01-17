<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // Nama kategori
        'description', // Deskripsi kategori
    ];

    /**
     * Relasi dengan tabel medicines
     *
     * @return HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}