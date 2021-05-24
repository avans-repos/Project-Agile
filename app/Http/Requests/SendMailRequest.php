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
      'contact' => 'array',
      'contact.*' => 'integer',
    ];
  }
  public function attributes()
  {
    return [
      'name' => 'Titel',
      'body' => 'Inhoud',
      'contact' => 'Contact',
    ];
  }
}
