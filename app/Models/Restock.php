<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_id', 'quantity', 'restock_date', 'supplier_name'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}