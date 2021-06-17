<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Company;
use App\Models\company_contact;
use App\Models\contact\Contact;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    $addressArray = [
      'street' => $row['straat'],
      'number' => $row['huisnummer'],
      'addition' => $row['toevoeging'],
      'zipcode' => $row['postcode'],
      'city' => $row['plaats'],
    ];

    $contact = Contact::create([
      'firstname' => $row['voornaam'],
      'insertion' => $row['tussenvoegsel'],
      'lastname' => $row['achternaam'],
      'email' => $row['mail_1'],
      'email2' => $row['mail_2'],
      'phonenumber' => $row['telefoon_1'],
      'phonenumber2' => $row['telefoon_2'],
      'address' => self::createAddressAndReturnId($addressArray),
    ]);

    if ($row['bedrijfsnaam'] != null || $row['bedrijfsnaam'] != '') {
      $company = Company::where('name', $row['bedrijfsnaam'])->first();

      if ($company != null) {
        company_contact::create([
          'company_id' => $company->id,
          'contact_id' => $contact->id,
          'contacttype' => 'warm',
          'added' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
      } else {
        $company = Company::create([
          'name' => $row['bedrijfsnaam'],
        ]);

        company_contact::create([
          'company_id' => $company->id,
          'contact_id' => $contact->id,
          'contacttype' => 'warm',
          'added' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
      }
    }

    return $contact;
  }

  protected function createAddressAndReturnId($addressArray)
  {
    $address = new Address([
      'streetname' => $addressArray['street'],
      'number' => $addressArray['number'],
      'addition' => $addressArray['addition'],
      'zipcode' => $addressArray['zipcode'],
      'city' => $addressArray['city'],
    ]);
    $returnId = null;
    // check if there is usable info in the result as the info is nullable
    if ($address->streetname != null && $address->number != null && $address->zipcode != null && $address->city != null) {
      $existing = Address::where('zipcode', $address->zipcode)
        ->where('number', $address->number)
        ->where('city', $address->city)
        ->first();

      if ($existing != null) {
        $existing->update($address->toArray());
        $returnId = $existing->id;
      } else {
        $createdAddress = Address::create($address->toArray());
        $returnId = $createdAddress->id;
      }
    }
    return $returnId;
  }
}
