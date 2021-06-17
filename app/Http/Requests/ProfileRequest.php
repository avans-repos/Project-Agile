<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    return [
      'email' => 'nullable|string|email|max:255',
      'password' => 'nullable|string|min:6|max:255|same:confirm_password',
      'confirm_password' => 'nullable',
    ];
  }
  public function attributes()
  {
    return [
      'email' => 'e-mail',
      'password' => 'wachtwoord',
      'confirm_password' => 'wachtwoord bevestiging',
    ];
  }
}
