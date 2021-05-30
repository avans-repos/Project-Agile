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
      'initials' => 'nullable|string|max:10',
      'firstname' => 'required|string|max:50',
      'insertion' => 'nullable|string|max:10',
      'lastname' => 'required|string|max:50',
      'gender' => 'nullable',
      'email' => 'nullable|email|max:320',
      'phonenumber' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
      'type' => 'nullable',
      'company-*' => 'nullable|string',
      'contactTypeSelector-*' => 'nullable|string',
      'streetname1' => 'max:100',
      'number1' => 'nullable|integer|max:2147483645|min:1',
      'addition1' => 'nullable|max:5',
      'zipcode1' => 'nullable|max:10',
      'city1' => 'nullable|max:100',
      'country1' => 'nullable|max:50',
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
      'streetname1' => 'straatnaam',
      'number1' => 'huisnummer',
      'addition1' => 'toevoeging',
      'zipcode1' => 'postcode',
      'city1' => 'stad',
      'country1' => 'land',
    ];
  }
}
