<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'stock',
        'price',
        'type',
        'description',
        'supplier_name',
        'expiry_date',
    ];

    protected $with = ['salesDetails', 'restocks'];

    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function restocks()
    {
        return $this->hasMany(Restock::class);
    }

    // Accessor untuk memformat harga
    public function getFormattedPriceAttribute()
    {
        return formatRupiah($this->price); // Panggil helper formatRupiah
    }

    // Mutator untuk format expiry_date
    public function getFormattedExpiryDateAttribute()
    {
        return Carbon::parse($this->expiry_date)->format('d F Y');
    }
}
