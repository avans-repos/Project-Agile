<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
      'name' => 'required|string',
      'body' => 'required|string',
      'contact' => 'array|required',
      'contact.*' => 'integer|required',
    ];
  }
  public function attributes()
  {
    return [
      'name' => 'titel',
      'body' => 'inhoud',
      'contact' => 'contact',
    ];
  }
}
