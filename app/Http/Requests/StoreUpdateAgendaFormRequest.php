<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAgendaFormRequest extends FormRequest
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
            'client' => 'required',
            'email' => 'required',
            'service' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'client' => 'cliente',
            'email' => 'email',
            'service' => 'serviço',
        ];
    }
}
