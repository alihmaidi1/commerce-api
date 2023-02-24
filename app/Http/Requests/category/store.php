<?php

namespace App\Http\Requests\category;

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

            "name"=>"required|unique:categories,name",
            "status"=>"required|in:0,1",
            "rank"=>"required|unique:categories,rank",
            "description"=>"required|string",
            "meta_description"=>"required|string",
            "meta_title"=>"required|string",
            "id_url"=>"required|exists:temps,id",
            "id_meta_logo"=>"required|exists:temps,id",


        ];
    }
}