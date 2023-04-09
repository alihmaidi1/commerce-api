<?php

namespace App\Http\Requests\copon;

use App\Rules\checkPrecentValue;
use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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

            "name"=>"required|unique:copons,name",
            "type"=>["required","in:precent,value",new checkPrecentValue],
            "value"=>"required|numeric",
            "currency_id"=>"exists:currencies,id",
            "end_at"=>"required|date"


        ];
    }
}