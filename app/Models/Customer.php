<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'disease', // tambahkan ini
    ];

    protected static function booted()
    {
        static::saving(function ($customer) {
            $customer->phone = self::formatPhoneNumber($customer->phone);

            if (!self::isValidPhoneNumber($customer->phone)) {
                throw new \InvalidArgumentException('Invalid Indonesian phone number');
            }
        });
    }

    public static function formatPhoneNumber($phone)
    {
        // Hapus karakter non-digit kecuali tanda "+"
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // Jika dimulai dengan "0", ubah menjadi "+62"
        if (str_starts_with($phone, '0')) {
            $phone = '+62' . substr($phone, 1);
        }

        return $phone;
    }

    public static function isValidPhoneNumber($phone)
    {
        // Pastikan sesuai format +62xxxxxxxxx (9-13 digit setelah +62)
        return preg_match('/^\+62[0-9]{9,13}$/', $phone);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}