<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'characteristic' => 'required',
            'image' => 'nullable|image|max:10000',
        ];
    }
}
