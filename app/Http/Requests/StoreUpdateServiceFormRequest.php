<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateServiceFormRequest extends FormRequest
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
            'service' => 'required',
            'time_service' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'service' => 'tipo de serviço',
            'time_service' => 'tempo de serviço',
        ];
    }

}
