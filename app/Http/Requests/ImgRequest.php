<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImgRequest extends Request
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
           'file' => 'required|mimes:bmp,png',
           #'file' => 'mimes:bmp,png',
           #'file' => 'dimensions:max_width=100,max_height=200'
        ];
    }

/*
   public function messages()
    {
        return [
            'file.required' => 'Файл должен быть',
            'file.mimes' => 'Допустимый формат: bmp,png',
            #'file.dimensions' => 'Размер больше 1800х1800',
        ];
    }
    */

}
