<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProfessionalFormRequest extends FormRequest
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
            'date_start' => 'required|date|before_or_equal:date_end',
            'date_end' => 'required|date',
            'interval' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'date_start' => 'periodo de atendimento (inicio)',
            'date_end' => 'periodo de atendimento (fim)',
            'interval' => 'intervalo entre horarios',
        ];
    }
}
