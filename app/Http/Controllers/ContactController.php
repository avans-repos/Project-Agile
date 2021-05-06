<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */

  public function index()
  {
    $contacts = Contact::all();
    return view('contact.index')->with('contacts', $contacts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
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
      'address' => $addressId
    ])->id;

    $data= $request->all();
    foreach(array_keys($request->all()) as $key){
      if(starts_with($key,'company-')){
        $id = explode('-',$key)[1];
        if(isset($data['contacttype-' . $id])){
          $company =  DB::table('companies')->where('name', '=', $data[$key])->get('id')->first();
          DB::insert('INSERT INTO contact_has_contacttypes (contact,company,contacttype) VALUES (?,?,?)', [$contactId,$company->id, $data['contacttype-' . $id]]);
        }
      }
    }

    return redirect()->route('contact.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\contact\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function show(Contact $contact)
  {
    $notes = DB::Table('notes')->where('contact', '=', $contact->id)->join('users', 'notes.creator', '=', 'users.id')->select( 'notes.id', 'notes.creation', 'notes.description','users.name')->orderBy('notes.creation', 'desc')->get() ?? [];
    $contactTypes = DB::Table('contact_has_contacttypes')->where('contact', '=', $contact->id)->join('companies', 'contact_has_contacttypes.company', '=', 'companies.id')->select('contact_has_contacttypes.contacttype', 'companies.name')->get() ?? [];
    $address = Address::find($contact->address);

    return view('contact.show')
      ->with('contact', $contact)
      ->with('address', $address)
      ->with('notes', $notes)
      ->with('contactTypes', $contactTypes);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\contact\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function edit(Contact $contact)
  {
    $genders = Gender::all();
    $contactTypes = ContactType::all();
    $companies = Company::all();
    $contactTypesAssigned = DB::Table('contact_has_contacttypes')->where('contact', '=', $contact->id)->join('companies', 'contact_has_contacttypes.company', '=', 'companies.id')->select('contact_has_contacttypes.contacttype', 'companies.name')->get() ?? [];
    $address = Address::find($contact->address);

    if ($address == null)
    {
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
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\contact\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function update(ContactRequest $request, Contact $contact)
  {
    $data = $request->all();

    DB::table('contact_has_contacttypes')->where('contact', $contact->id)->delete();


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
      'address' => $addressId
      ]);


    $data= $request->all();
    foreach(array_keys($request->all()) as $key){
      if(starts_with($key,'company-')){
        $id = explode('-',$key)[1];
        if(isset($data['contacttype-' . $id]) &&  $data['contacttype-' . $id] != "n.v.t."){
          $company =  DB::table('companies')->where('name', '=', $data[$key])->get('id')->first();
          DB::insert('INSERT INTO contact_has_contacttypes (contact,company,contacttype) VALUES (?,?,?)', [$contact->id,$company->id, $data['contacttype-' . $id]]);
        }
      }
    }

    return redirect()->route('contact.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\contact\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function destroy(Contact $contact)
  {
    $contact->delete();
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
    if ($address->streetname != null && $address->number != null && $address->zipcode != null && $address->city != null && $address->country != null)
    {
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

function starts_with($haystack, $needle) {
  return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}


