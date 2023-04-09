<?php

namespace App\Http\Requests\copon;

use App\Rules\checkPrecentValue;
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
        error_log(request("copon"));
        error_log(request("id"));

        return [

            "name"=>"required|unique:copons,name,".request("copon")->id,
            "value"=>"required|numeric",
            "type"=>["required","in:precent,value",new checkPrecentValue],
            "end_at"=>"required|date",
            "currency_id"=>"required|exists:currencies,id"

        ];
    }
}