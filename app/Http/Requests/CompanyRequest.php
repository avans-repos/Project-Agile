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
      'streetname1' => 'required|max:100',
      'number1' => 'required|max:11',
      'addition1' => 'max:5',
      'zipcode1' => 'required|max:10',
      'city1' => 'required|max:100',
      'country1' => 'required|max:50',
      'streetname2' => 'required_if:address_same,1|max:100',
      'number2' => 'required_if:address_same,1|max:11',
      'addition2' => 'max:5',
      'zipcode2' => 'required_if:address_same,1|max:10',
      'city2' => 'required_if:address_same,1|max:100',
      'country2' => 'required_if:address_same,1|max:50',
    ];
  }

  public function withValidator($validator)
  {
    $validator->after(function ($validator) {

      $zipcodeNumberCity1 = $this->zipcode1 . $this->number1 . $this->city1;
      $zipcodeNumberCity2 = $this->zipcode2 . $this->number2 . $this->city2;

      if ($zipcodeNumberCity1 == $zipcodeNumberCity2) {
        $validator->errors()->add('zipcode2', 'De postadres postcode is hetzelfde als de bezoekadres postcode');
      }
    });
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
