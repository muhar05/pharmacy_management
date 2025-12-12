<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',    // Nama supplier
        'address', // Alamat supplier
        'phone',   // Nomor telepon supplier
        'email',   // Email supplier
    ];

    /**
     * Relasi dengan tabel medicines
     *
     * @return HasMany
     */
    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
}