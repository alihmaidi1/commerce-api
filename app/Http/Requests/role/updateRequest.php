<?php

namespace App\Http\Requests\role;

use App\Models\role;
use App\Rules\checkPermissionRule;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $role=role::first();
        if($role->id!=request("role")->id){

            return true;

        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "name"=>"required|unique:roles,name",
            "permissions"=>["array","required"],
            "permissions.*"=>[new checkPermissionRule]
        ];
    }
}