<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRegistrationRequest extends Request
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
            'mailing_add'           => 'required',
            'town_city'             => 'required',
            'province'              => 'required',
            'zip_code'              => 'required|integer',
            'contact'               => 'required'
        ];
    }

    public function messages()
    {
        return [
            'lastname.required'             => 'Lastname field is required',
            'firstname.required'            => 'Firstname field is required',
            'middlename.required'           => 'Middlename field is required',
            'course.required'               => 'Course field is required. Please select from menu',
            'gender.required'               => 'Gender field is required. Please select from menu',
            'maritalstatus.required'        => 'Marital Status field is required. Please select from menu',
            'religion.required'             => 'Religion field is required. Please select from menu',
            'nationality.required'          => 'Nationality field is required',
            'mailing_add.required'          => 'Mailing Address field is required',
            'town_city.required'            => 'Town / City field is required',
            'province.required'             => 'Province field is required',
            'zip_code.required'             => 'Zip Code field is required. Please select from menu',
            'zip_code.integer'              => 'Zip Code field must be a number',
            'contact.required'              => 'Contact Number field is required'
        ];
    }
}
