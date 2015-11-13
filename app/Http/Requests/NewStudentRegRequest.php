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
            'dob'                   => 'required:date',
            'pob'                   => 'required',
            'mailing_add'           => 'required',
            'town_city'             => 'required',
            'province'              => 'required',
            'zip_code'              => 'required|integer',
            'contact'               => 'required',
            'emailadd'              => 'required|email',
            'father_name'           => 'required',
            'father_occupation'     => 'required',
            'mother_name'           => 'required',
            'mother_occupation'     => 'required',
            'username'              => 'required',
            'password'              => 'required|same:repeat_password',
            'repeat_password'       => 'required'
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
            'dob.required'                  => 'Date Of Birth field is required',
            'dob.date'                      => 'Date Of Birth field must be a date',
            'pob.required'                  => 'Place of Birth field is required',
            'mailing_add.required'          => 'Mailing Address field is required',
            'town_city.required'            => 'Town / City field is required',
            'province.required'             => 'Province field is required',
            'zip_code.required'             => 'Zip Code field is required. Please select from menu',
            'zip_code.integer'              => 'Zip Code field must be a number',
            'contact.required'              => 'Contact Number field is required',
            'emailadd.required'             => 'Email Address field is required',
            'emailadd.email'                => 'Email Address must be a valid email address',
            'father_name.required'          => 'Father name field is required',
            'father_occupation.required'    => 'Father\'s Occupation field is required',
            'mother_name.required'          => 'Mother name field is required',
            'mother_occupation.required'    => 'Mother\'s Occupation field is required',
            'username.required'             => 'Username field is required',
            'password.required'             => 'Password name field is required',
            'repeat_password.required'      => 'Repeat password field is required',
            'password.same'                 => 'Password and Repeat password must match'
        ];
    }
}
