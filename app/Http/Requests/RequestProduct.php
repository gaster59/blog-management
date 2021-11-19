<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
{

    public function __construct()
    {

    }

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
        $method   = $this->input('method', '');
        $validate = [
            'name'   => 'required|max:75',
            'description' => 'max:200',
            'summary' => 'required',
            'avatar'  => 'required|mimes:jpg,png',
        ];
        if ('edit' == $method) {
            $validate['avatar'] = 'mimes:jpg,png';
        }
        return $validate;
    }
}
