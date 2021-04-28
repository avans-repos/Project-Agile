<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
      'name' =>  'required|string|min:3|max:255',
      'year' => 'required|integer|min:0|max:9999',
      'student' => 'array',
      'student.*' => 'integer'
    ];
  }

  public function attributes()
  {
    return [
      'name' => 'Klasnaam',
      'year' => 'Jaar',
      'student' => 'Student'
    ];
  }
}
