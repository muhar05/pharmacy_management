<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'user_id', 'sale_date', 'total_amount', 'payment_status', 'doctor_name',
        'doctor_phone',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

        // Accessor untuk memformat harga
    public function getFormattedPriceAttribute()
    {
        return formatRupiah($this->price); // Panggil helper formatRupiah
    }

    
    public function getFormattedSaleDateAttribute()
    {
        return Carbon::parse($this->sale_date)->format('d F Y');
    }
}