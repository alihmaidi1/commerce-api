<?php

namespace App\Http\Requests\slider;

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

            "rank"=>"required|unique:sliders,ranks",
            "status"=>"required|in:0,1",
            "image_id"=>"exists:temps,id"

        ];
    }
}
