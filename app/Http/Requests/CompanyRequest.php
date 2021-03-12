<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
      'name' => 'required|string|max:50',
      'phonenumber' => 'required|string|max:15',
      'email' => 'required|email|max:320',
      'size' => 'required|numeric|min:0',
      'website' => 'required|url|max:255',
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
    ];
  }
}
