<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefereRequest extends FormRequest
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
            'id'=>'bail|required|integer|unique:referes',
            'demandeur'=>'bail|required|min:2',
            'defendeur'=>'bail|required|min:2',
            'date_requete'=>'bail|required|date|before_or_equal:today',
            'date_audience'=>'bail|required|date|after_or_equal:date_requete',
            'motif_assignation'=>'bail|required|min:2'
        ];
    }
}
