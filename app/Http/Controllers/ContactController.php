<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\company_contact;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use App\Models\Note;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|View|Response
   */

  public function index()
  {
    $contacts = Contact::all();

    return view('contact.index')->with('contacts', $contacts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Application|Factory|View|Response
   */
  public function create()
  {
    $contact = new Contact();
    $genders = Gender::all();
    $contactTypes = ContactType::all();
    $companies = Company::all();
    $address = new Address();

    return view('contact.manage')
      ->with('contact', $contact)
      ->with('genders', $genders)
      ->with('contactTypes', $contactTypes)
      ->with('companies', $companies)
      ->with('address', $address)
      ->with('contactTypesAssigned', [])
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(ContactRequest $request)
  {
    $request->validated();

    $addressId = self::createAddressAndReturnId($request);

    $contactId = Contact::create([
      'initials' => $request->input('initials'),
      'firstname' => $request->input('firstname'),
      'insertion' => $request->input('insertion'),
      'lastname' => $request->input('lastname'),
      'gender' => $request->input('gender'),
      'email' => $request->input('email'),
      'phonenumber' => $request->input('phonenumber'),
      'type' => $request->input('type'),
      'address' => $addressId,
    ])->id;

    $data = $request->all();
    foreach (array_keys($request->all()) as $key) {
      if (starts_with($key, 'company-')) {
        $id = explode('-', $key)[1];
        if (isset($data['contacttype-' . $id])) {
          $company = Company::where('name', '=', $data[$key])
            ->get('id')
            ->first();

          $company_has_contact = new company_contact();
          $company_has_contact->contact = $contactId;
          $company_has_contact->company = $company->id;
          $company_has_contact->contacttype = $data['contacttype-' . $id];
          $company_has_contact->save();
        }
      }
    }

    return redirect()->route('contact.index');
  }

  /**
   * Display the specified resource.
   *
   * @param Contact $contact
   * @return Response
   */
  public function show(Contact $contact)
  {
    return view('contact.show')->with('contact', $contact);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Contact $contact
   * @return Response
   */
  public function edit(Contact $contact)
  {
    $genders = Gender::all();
    $contactTypes = ContactType::all();
    $companies = Company::all();
    $contactTypesAssigned =
      DB::Table('company_has_contacts_has_contacttypes')
        ->where('contact', '=', $contact->id)
        ->join('companies', 'company_has_contacts_has_contacttypes.company', '=', 'companies.id')
        ->select('company_has_contacts_has_contacttypes.contacttype', 'companies.name')
        ->get() ?? [];
    $address = Address::find($contact->address);

    if ($address == null) {
      $address = new Address();
    }

    return view('contact.manage')
      ->with('contact', $contact)
      ->with('address', $address)
      ->with('genders', $genders)
      ->with('contactTypes', $contactTypes)
      ->with('companies', $companies)
      ->with('contactTypesAssigned', $contactTypesAssigned)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Contact $contact
   * @return Response
   */
  public function update(ContactRequest $request, Contact $contact)
  {
    $data = $request->all();

    DB::table('company_has_contacts_has_contacttypes')
      ->where('contact', $contact->id)
      ->delete();

    $request->validated();

    $addressId = self::createAddressAndReturnId($request);

    $contact->update([
      'initials' => $request->input('initials'),
      'firstname' => $request->input('firstname'),
      'insertion' => $request->input('insertion'),
      'lastname' => $request->input('lastname'),
      'gender' => $request->input('gender'),
      'email' => $request->input('email'),
      'phonenumber' => $request->input('phonenumber'),
      'type' => $request->input('type'),
      'address' => $addressId,
    ]);

    $data = $request->all();
    foreach (array_keys($request->all()) as $key) {
      if (starts_with($key, 'company-')) {
        $id = explode('-', $key)[1];
        if (isset($data['contacttype-' . $id]) && $data['contacttype-' . $id] != 'n.v.t.') {
          $company = Company::where('name', '=', $data[$key])
            ->get('id')
            ->first();

          $company_has_contact = new company_contact();
          $company_has_contact->contact = $contact->id;
          $company_has_contact->company = $company->id;
          $company_has_contact->contacttype = $data['contacttype-' . $id];
          $company_has_contact->save();
        }
      }
    }

    return redirect()->route('contact.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Contact $contact
   * @return Response
   */
  public function destroy(Contact $contact)
  {
    if (Auth::user()->isAdmin()) {
      $contact->delete();
    }
    return redirect()->route('contact.index');
  }

  protected function createAddressAndReturnId($request)
  {
    $address = new Address([
      'streetname' => $request->input('streetname1'),
      'number' => $request->input('number1'),
      'addition' => $request->input('addition1'),
      'zipcode' => $request->input('zipcode1'),
      'city' => $request->input('city1'),
      'country' => $request->input('country1'),
    ]);
    $returnId = null;
    // check if there is usable info in the result as the info is nullable
    if (
      $address->streetname != null &&
      $address->number != null &&
      $address->zipcode != null &&
      $address->city != null &&
      $address->country != null
    ) {
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

function starts_with($haystack, $needle)
{
  return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
