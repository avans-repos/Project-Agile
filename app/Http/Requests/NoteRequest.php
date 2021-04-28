<?php


namespace App\Http\Requests;


use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use League\Flysystem\Exception;

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

  public function withValidator($validator)
  {
    $validator->after(function ($validator) {
      if($this->reminderdate != null || $this->reminderdate != '') {
        try {
          $date = Carbon::createFromFormat('Y-m-d',$this->reminderdate);
        } catch (InvalidFormatException $e) {
          $validator->errors()->add('reminderdate','De datum is niet in het juiste formaat genoteerd. Controleer of deze voldoet aan DD-MM-YYYY (Dag, maand, jaar).');
        }
      }
    });
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
