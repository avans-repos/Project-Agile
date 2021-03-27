<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
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
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $contacts = Contact::all();
    return view('contact.index')->with('contacts', $contacts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
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
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ContactRequest $request)
  {
    $request->validated();
    Contact::create($request->all());
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
    return view('contact.show')->with('contact', $contact)->with('notes', $notes);
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
    return view('contact.manage')
      ->with('genders', $genders)
      ->with('contactTypes', $contactTypes)
      ->with('contact', $contact)
      ->with('companies', $companies)
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
    $request->validated();
    $contact->update($request->all());
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
}
