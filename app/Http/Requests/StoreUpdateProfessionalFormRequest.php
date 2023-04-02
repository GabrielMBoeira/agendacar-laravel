<?php

namespace App\Http\Requests;

use App\Rules\validateDatesOneYear;
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
        $rules = [
            'name' => 'required',
            'date_start' => ['required','date','before_or_equal:date_end', new validateDatesOneYear],
            'date_end' => 'required|date',
            'interval' => 'required',
            'time_service1' => 'required_with:service1',
            'time_service2' => 'required_with:service2',
            'time_service3' => 'required_with:service3',
            'time_service4' => 'required_with:service4',
            'time_service5' => 'required_with:service5',
            'service1' => 'required_with:time_service1',
            'service2' => 'required_with:time_service2',
            'service3' => 'required_with:time_service3',
            'service4' => 'required_with:time_service4',
            'service5' => 'required_with:time_service5',

        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'date_start' => 'periodo de atendimento (inicio)',
            'date_end' => 'periodo de atendimento (fim)',
            'interval' => 'intervalo entre horarios',
            'interval' => 'intervalo entre horarios',
            'time_service1' => 'tempo de atendimento do servico 1',
            'time_service2' => 'tempo de atendimento do servico 2',
            'time_service3' => 'tempo de atendimento do servico 3',
            'time_service4' => 'tempo de atendimento do servico 4',
            'time_service5' => 'tempo de atendimento do servico 5',
            'service1' => 'servico 1',
            'service2' => 'servico 2',
            'service3' => 'servico 3',
            'service4' => 'servico 4',
            'service5' => 'servico 5'
        ];
    }
}
