<?php

namespace App\Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
            'taxpayer_id' => 'required|unique:users,taxpayer_id',
            'type' => 'required|in:shopkeeper,common',
            'balance' => 'required|numeric'
        ];
    }
}
