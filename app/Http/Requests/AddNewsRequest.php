<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'fio' => 'required',
            'news_type' => 'required',
            'title' => 'required',
            'descr' => 'required',
            'shortDescr' => 'required'
        ];
    }
}
