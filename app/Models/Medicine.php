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
        'stock',
        'price',
        'category_id',
        'type',
        'description',
        'supplier_name',
        'supplier_id',
        'dosage',
        'instructions',
        'unit',
        'minimum_stock',
        'expiry_date',
        'require_prescription'
    ];

    protected $with = ['salesDetails', 'restocks'];

     protected $dates = ['expiry_date']; 

    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function restocks()
    {
        return $this->hasMany(Restock::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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