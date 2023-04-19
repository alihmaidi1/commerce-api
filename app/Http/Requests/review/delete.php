<?php

namespace App\Http\Requests\review;

use App\Rules\checkreviewowner;
use Illuminate\Foundation\Http\FormRequest;

class delete extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(){

        $this->merge(["id"=>$this->route("review")]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "id"=>["required","exists:reviews,id",new checkreviewowner]

        ];
    }
}
