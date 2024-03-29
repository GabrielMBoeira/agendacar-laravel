<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => [
                'required',
                'same:password'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'password' => 'senha',
            'confirm_password' => 'confirme sua senha',
        ];
    }
}
