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
      'name' =>  'required|string|min:3|max:10',
      'year' => 'required|integer|min:1901|max:2150',
      'student' => 'array',
      'student.*' => 'integer',
    ];
  }

  public function attributes()
  {
    return [
      'name' => 'Klasnaam',
      'year' => 'Jaar',
      'schoolBlock' => 'Blok',
      'student' => 'Student'
    ];
  }
}
