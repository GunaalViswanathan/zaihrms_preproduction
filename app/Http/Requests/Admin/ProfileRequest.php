<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class ProfileRequest extends FormRequest
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
                'required', 'min:3', 'max:25',
            ],
            'last_name' => [
                'required', 'min:3', 'max:25',
            ],
            'email' => [
                'required', 'email','regex:'.$m_reg, Rule::unique((new User())->getTable())->ignore($this->route()->user ?? null)
            ],
            'personal_email' => [
                'required', 'email','regex:'.$m_reg, Rule::unique((new UserProfile())->getTable())->ignore($this->route()->user ?? null)
            ],
            'mobile_no' => [
                'required', 'regex:/^([0-9\s\-\+\(\)]*)$/','digits:10', 'unique:userprofiles,mobile_no,'.$this->route()->user.',user_id'
            ],
            'alternate_mobile_number'  => [
                'required', 'numeric', 'digits:10', 'different:mobile_no', 'unique:userprofiles,alternate_mobile_number,'.$this->route()->user.',user_id'
            ],
            'dob' => [
                'required', 'date', 'before:-18 years',
            ],
            'father_name' => [
                'required', 'min:3', 'max:25',
            ],
            'mother_name' => [
                'required', 'min:3', 'max:25',
            ],
            'pan_number' => [
                'required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            ],
            'aadhar_number' => [
                'required', 'digits:12',
            ],
            'bank_name' => [
                'required', 'min:3', 'max:25',
            ],
            'account_number' => [
                'required', 'min:3', 'max:20',
            ],
            'ifsc_code' => [
                'required', 'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            ],
            'account_holder_name' => [
                'required', 'min:3', 'max:25',
            ],
            'user_photo' => [
                'nullable','mimes:jpg,jpeg,png','max:1024'
            ],
            'reporting_to' => [
                'nullable'
            ],
            'residential_address' => [
                'required', 'min:3', 'max:100',
            ],
            'permanent_address' => [
                'required', 'min:3', 'max:100',
            ],
            'blood_group' => [
                'required'
            ],
            'date_of_joining' => [
                'required', 'date',
            ],
        ];
    }

    public function messages()
    {
        return [
            'mobile_no.required' => 'The mobile number field is required.',
            'mobile_no.digits'   => 'The mobile number must be 10 digits.',
            'mobile_no.regex'    => 'The mobile number must be 10 digits without leading zero.',
            'mobile_no.unique'   => 'The mobile number has already taken.',
            'alternate_mobile_number.different' => 'The alternate mobile number and mobile number must be different.',
        ];
    }

}
