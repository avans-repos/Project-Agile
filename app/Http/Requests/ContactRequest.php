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
            'initials'=>'required|string',
            'firstname'=>'required|string',
            'insertion'=>'nullable',
            'lastname'=>'required|string',
            'gender'=>'required',
            'email'=>'required|email',
            'phonenumber'=>'required',
            'type'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            'initials'=>'voorletters',
            'firstname'=>'voornaam',
            'insertion'=>'tussenvoegsel',
            'lastname'=>'achternaam',
            'gender'=>'geslacht',
            'email'=>'e-mail',
            'phonenumber'=>'telefoonnummer',
            'type'=>'contactsoort'
        ];
    }
}
