<?php

namespace App\Http\Requests\admin;

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
            "name"=>"required",
            "email"=>"required|email|unique:admins,email",
            "password"=>"required",
            "phone"=>"required|unique:admins,phone",
            "role_id"=>["required","exists:roles,id"]
        ];
    }
}
