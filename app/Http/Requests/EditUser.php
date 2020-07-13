<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUser extends FormRequest
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
      //emailに重複禁止バリデーションを設定すると、ユーザ情報更新の際にメールアドレスを変更しないとエラーが発生する。
        return [
            'name' => 'required',
            'email' => 'email',
            'profile' => 'max:255',
        ];
    }
}
