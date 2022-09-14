<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $m_reg = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'; //for mail
        return [
            'first_name' => [
                'required', 'min:1', 'max:25', 'regex:/^([[a-zA-Z0-9\s\-\s\_\(\)]*)$/'
            ],
            'last_name' => [
                'required', 'min:1', 'max:25', 'regex:/^([[a-zA-Z0-9\s\-\s\_\(\)]*)$/'
            ],
            'email' => [
                'required', 'email','regex:'.$m_reg, Rule::unique((new User)->getTable())->ignore($this->route()->user ?? null)
            ],
            'mobile_number' => [
                'required', 'regex:/^[6-9]\d{9}$/',
            ],
            'password' => [
                $this->route()->user ? 'nullable' :'required', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'user_photo' => [
                'nullable','mimes:jpg,jpeg,png','max:1024'
            ],
        ];
    }

    public function messages()
    {
        return [
            'mobile_no.required' => 'The mobile no field is required.',
            'mobile_no.digits'   => 'The mobile no must be 10 digits.',
            'mobile_no.regex'    => 'The mobile no must be 10 digits without leading zero.',
            'mobile_no.unique'   => 'The mobile no has already taken.',
            'password.regex'     => 'Password should have at least 1 lowercase AND 1 uppercase AND 1 number',
            'pincode.required'   => 'The zipcode field is required.',
            'pincode.regex'      => 'The zipcode should be numeric and between 5 to 10 digits.',
        ];
    }

}
