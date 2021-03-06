<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertSubjectCurriculumRequest extends Request
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
            'subject'       => 'required',
            'yearlevel'     => 'required',
            'term'          => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required'      => 'Subject field is required',
            'yearlevel.required'    => 'Yearlevel field is required',
            'term.required'         => 'Term field is required'
        ];
    }
}
