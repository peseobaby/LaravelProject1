<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'name' => 'bail|required|',
            'email' => 'bail|required|email|',
            'age' => 'required|num',
            'address' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' =>  'Tên không để trống',
            'email.required' => 'Email không để trống',
            'email.email' => 'Email phải có định dạng @abc',
            'age.required' => ' điền tuổi',
            'address.required' => 'địa chỉ không được để trống',
        ];
    }
}
