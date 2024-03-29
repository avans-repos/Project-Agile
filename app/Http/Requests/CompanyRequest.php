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
      'phonenumber' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
      'email' => 'required|email|max:320',
      'size' => 'nullable|min:0|integer|max:2147483646',
      'website' => 'nullable|string|max:255',
      'streetname1' => 'required|max:100',
      'number1' => 'required|integer|max:2147483645|min:1',
      'addition1' => 'max:5',
      'zipcode1' => 'required|max:10',
      'city1' => 'required|max:100',
      'country1' => 'required|max:50',
      'streetname2' => 'required_if:address_same,1|max:100',
      'number2' => 'required_if:address_same,1|integer|max:2147483645|min:1|nullable',
      'addition2' => 'max:5|nullable',
      'zipcode2' => 'required_if:address_same,1|max:10|nullable',
      'city2' => 'required_if:address_same,1|max:100|nullable',
      'country2' => 'required_if:address_same,1|max:50|nullable',
    ];
  }

  public function withValidator($validator)
  {
    $validator->after(function ($validator) {
      if ($this->address_same == 1) {
        $zipcodeNumberCity1 = $this->zipcode1 . $this->number1 . $this->city1;
        $zipcodeNumberCity2 = $this->zipcode2 . $this->number2 . $this->city2;

        if ($zipcodeNumberCity1 == $zipcodeNumberCity2) {
          $validator->errors()->add('zipcode2', 'De postadres postcode is hetzelfde als de bezoekadres postcode');
        }
      }
    });
  }

  public function attributes()
  {
    return [
      'name' => 'bedrijfsnaam',
      'phonenumber' => 'telefoonnummer',
      'email' => 'e-mail',
      'size' => 'aantal medewerkers',
      'website' => 'website',
      'streetname1' => 'bezoekadres - straatnaam',
      'number1' => 'bezoekadres - huisnummer',
      'addition1' => 'bezoekadres - toevoeging',
      'zipcode1' => 'bezoekadres - postcode',
      'city1' => 'bezoekadres - plaatsnaam',
      'country1' => 'bezoekadres - land',
      'streetname2' => 'postadres - straatnaam',
      'number2' => 'postadres - huisnummer',
      'addition2' => 'postadres - toevoeging',
      'zipcode2' => 'postadres - postcode',
      'city2' => 'postadres - plaatsnaam',
      'country2' => 'land',
    ];
  }
}
