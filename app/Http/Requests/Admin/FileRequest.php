<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'select_file' => 'required|mimes:xls,xlsx,csv'
        ];
    }

    public function attributes()
    {
        return [
            'select_file' => 'File',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute chưa được chọn',
            'mimes' => ':attribute không đúng định dạng'
        ];
    }
}
