<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'level' => 'required_without_all',
            'department' => 'required_without_all',
            'age' => 'required|numeric',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>  'Tên không để trống',
            'level.required_without_all' => 'Chọn 1',
            'department.required_without_all' => 'Chọn 1',
            'age.required' => ' điền tuổi',
            'address.required' => 'địa chỉ không được để trống',
        ];
    }
}
