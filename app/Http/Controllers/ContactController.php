<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Models\contact\Contact;
use App\Models\contact\ContactType;
use App\Models\contact\Gender;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function index()
  {
    $contacts = Contact::all();
    return view('contact.index')->with('contacts', $contacts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $genders = Gender::all();
    $contactTypes = ContactType::all();
    $contact = new Contact();
    $companies = Company::all();
    return view('contact.manage')
      ->with('genders', $genders)
      ->with('contactTypes', $contactTypes)
      ->with('contact', $contact)
      ->with('companies', $companies)
      ->with('contactTypesAssigned', [])
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(ContactRequest $request)
  {
    $request->validated();
    $contactId = Contact::create($request->all())->id;
    $data = $request->all();
    foreach (array_keys($request->all()) as $key) {
      if (starts_with($key, 'company-')) {
        $id = explode('-', $key)[1];
        if (isset($data['contacttype-' . $id])) {
          $company = DB::table('companies')
            ->where('name', '=', $data[$key])
            ->get('id')
            ->first();
          DB::insert('INSERT INTO contact_has_contacttypes (contact,company,contacttype) VALUES (?,?,?)', [
            $contactId,
            $company->id,
            $data['contacttype-' . $id],
          ]);
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
    $notes =
      DB::Table('notes')
        ->where('contact', '=', $contact->id)
        ->join('users', 'notes.creator', '=', 'users.id')
        ->select('notes.id', 'notes.creation', 'notes.description', 'users.name')
        ->orderBy('notes.creation', 'desc')
        ->get() ?? [];
    $contactTypes =
      DB::Table('contact_has_contacttypes')
        ->where('contact', '=', $contact->id)
        ->join('companies', 'contact_has_contacttypes.company', '=', 'companies.id')
        ->select('contact_has_contacttypes.contacttype', 'companies.name')
        ->get() ?? [];

    return view('contact.show')
      ->with('contact', $contact)
      ->with('notes', $notes)
      ->with('contactTypes', $contactTypes);
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
      DB::Table('contact_has_contacttypes')
        ->where('contact', '=', $contact->id)
        ->join('companies', 'contact_has_contacttypes.company', '=', 'companies.id')
        ->select('contact_has_contacttypes.contacttype', 'companies.name')
        ->get() ?? [];
    return view('contact.manage')
      ->with('genders', $genders)
      ->with('contactTypes', $contactTypes)
      ->with('contact', $contact)
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

    DB::table('contact_has_contacttypes')
      ->where('contact', $contact->id)
      ->delete();

    $data = $request->all();
    foreach (array_keys($request->all()) as $key) {
      if (starts_with($key, 'company-')) {
        $id = explode('-', $key)[1];
        if (isset($data['contacttype-' . $id]) && $data['contacttype-' . $id] != 'n.v.t.') {
          $company = DB::table('companies')
            ->where('name', '=', $data[$key])
            ->get('id')
            ->first();
          DB::insert('INSERT INTO contact_has_contacttypes (contact,company,contacttype) VALUES (?,?,?)', [
            $contact->id,
            $company->id,
            $data['contacttype-' . $id],
          ]);
        }
      }
    }

    $request->validated();
    $contact->update($request->all());
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
    $contact->delete();
    return redirect()->route('contact.index');
  }
}

function starts_with($haystack, $needle)
{
  return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
