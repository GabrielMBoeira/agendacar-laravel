<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendaDate extends FormRequest
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
            'date_start' => 'required',
            'date_end' => 'required',
            'interval' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'date_start' => 'período de atendimento (início)',
            'date_end' => 'período de atendimento (fim)',
            'interval' => 'interval',
        ];
    }
}
