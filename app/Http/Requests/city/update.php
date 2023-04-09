<?php

namespace App\Http\Requests\city;

use Illuminate\Foundation\Http\FormRequest;

class update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "name"=>"required",
            "country_id"=>"required|exists:countries,id",
            "price"=>'required|numeric',
            "currency_id"=>"required|exists:currencies,id"

        ];
    }
}