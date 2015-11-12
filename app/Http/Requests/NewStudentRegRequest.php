<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewStudentRegRequest extends Request
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
            'lastname'              => 'required',
            'firstname'             => 'required',
            'middlename'            => 'required',
            'course'                => 'required',
            'gender'                => 'required',
            'maritalstatus'         => 'required',
            'religion'              => 'required',
            'nationality'           => 'required',
            'dob'                   => 'required',
            'pob'                   => 'required',
            'mailing_add'           => 'required',
            'town_city'             => 'required',
            'province'              => 'required',
            'zip_code'              => 'required',
            'contact'               => 'required',
            'emailadd'              => 'required',
            'father_name'           => 'required',
            'father_occupation'     => 'required',
            'mother_name'           => 'required',
            'mother_occupation'     => 'required',
            'username'              => 'required',
            'password'              => 'required|same:repeat_password',
            'repeat_password'       => 'required'
        ];
    }
}
