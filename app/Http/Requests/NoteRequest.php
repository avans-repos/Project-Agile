<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
    'description' => 'required|string',
    'reminderdate' => 'required_if:reminder,1|after:today'
  ];
  }

  public function attributes()
  {
    return [
      'description' => 'beschrijving',
    ];
  }

  public function messages()
  {
    return [
      'reminderdate.after' => 'De herinneringsdatum moet later zijn dan vandaag.',
    ];
  }

}
