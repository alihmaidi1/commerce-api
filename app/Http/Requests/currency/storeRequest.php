<?php

namespace App\Http\Requests\currency;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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

            "code"=>"required|unique:currencies,code",
            "name"=>"required|unique:currencies,name",
            "value"=>"required|numeric"


        ];
    }
}