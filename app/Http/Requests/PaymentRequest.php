<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'fio' => 'required',
            'country' => 'required',
            'email' => 'required',
            'telephone' => 'required'
        ];
    }
}
