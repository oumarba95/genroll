<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CivileRequest extends FormRequest
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
            'id'=>'bail|required|integer|unique:civiles',
            'demandeur'=>'bail|required|min:2',
            'date_requete'=>'bail|required|date|before_or_equal:today',
            'date_audience'=>'bail|required|date|after_or_equal:date_requete',
            'motifs'=>'bail|required|min:2',
            'civile_type_id'=>'bail|required|in:1,2,3',
            'defendeur'=>'bail|required_if:civile_type_id,3,1',
            'id_role'=>'bail|required_if:civile_type_id,3|unique:role_generals',
        ];
    }
}
