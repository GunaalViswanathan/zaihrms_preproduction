<?php

namespace App\Http\Requests\Admin;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use LaraSnap\LaravelAdmin\Models\Category;

class ItdeclarationRequest extends FormRequest
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
        $data=FormRequest::all();
        $category=Category::find($data['category']);
        if($category) {


            if ($data['category'] == 6) {
                $rules['childcategory'] = 'required';
                $rules['company_name'] = 'required';
                $rules['amount'] = 'required';
            } elseif ($category->name == 'details-of-rent-paid') {
                $rules['company_name'] = 'required';
                $rules['address'] = 'required';
                $rules['amount'] = 'required';
            } else {
                $rules['company_name'] = 'required';
                $rules['amount'] = 'required';
            }
        }
        else{
            $rules['category'] = 'required';
        }
           return
                $rules;


    }
    public function messages()
    {
        $data=FormRequest::all();
     $category=Category::find($data['category']);
     if($category) {

         if ($category->name == 'details-of-rent-paid') {
             $message['company_name.required'] = 'Name is required';
             $message['address.required'] = 'Address is required';
         } else {

             $message['childcategory.required'] = 'Category is required';
             $message['company_name.required'] = 'Name is required';
             $message['amount.required'] = 'Amount is required';
             $message['childcategory.required'] = 'Sub category is required';
         }
     }
     else{
         $message['category.required'] = 'Category is required';
     }
     return $message;
    }

}
