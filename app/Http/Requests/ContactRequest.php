<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
      'initials' => 'required|string|max:10',
      'firstname' => 'required|string|max:50',
      'insertion' => 'nullable|string|max:10',
      'lastname' => 'required|string|max:50',
      'gender' => 'required',
      'email' => 'nullable|email|max:320',
      'phonenumber' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
      'type' => 'nullable',
      'company-*' => 'nullable|string',
      'contactTypeSelector-*' => 'nullable|string',
    ];
  }

  public function attributes()
  {
    return [
      'initials' => 'voorletters',
      'firstname' => 'voornaam',
      'insertion' => 'tussenvoegsel',
      'lastname' => 'achternaam',
      'gender' => 'geslacht',
      'email' => 'e-mail',
      'phonenumber' => 'telefoonnummer',
      'type' => 'contactsoort',
      'company-*' => 'bedrijf',
      'contactTypeSelector-*' => 'contactType',
    ];
  }
}
