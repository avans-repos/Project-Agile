<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionpointRequest extends FormRequest
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
      'deadline' => 'required|after:tomorrow',
      'title' => 'required',
      'reminderdate' => 'nullable|after:today',
      'assigned' => 'array|required',
      'assigned.*' => 'integer|required',
    ];
  }

  public function attributes()
  {
    return [
      'deadline' => 'deadline',
      'title' => 'titel',
      'description' => 'beschrijving',
      'reminderdate' => 'herinneringsdatum',
      'assigned' => 'docenten',
    ];
  }

  public function messages()
  {
    return [
      'reminderdate.after' => 'De herinneringsdatum moet later zijn dan vandaag.',
    ];
  }
}
