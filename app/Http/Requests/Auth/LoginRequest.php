<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false; // Con False activo no dejarà ingresar a nuestra app

        return true; // Con true activo dejarà ingresar a nuestra app

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email"=>"required|email",
            "password"=>"required|max:200|min:6"
        ];
    }
}
