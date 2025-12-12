<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicineUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'], 
            'stock' => ['required', 'integer'], 
            'type' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],    
            'supplier_name' => ['required', 'string', 'max:255'],
            'expiry_date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }
}