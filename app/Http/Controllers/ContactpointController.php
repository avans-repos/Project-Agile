<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactpointRequest;
use App\Models\contact\Contact;
use App\Models\Contactpoint;
use App\Service\AuthenticationService;

class ContactpointController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService)
  {
    $this->AuthenticationService = $authenticationService;
  }

  public function index()
  {
  }

  public function create(int $id)
  {
    $contactpoint = new Contactpoint();
    $contactpoint->dateOfContact = date('c');

    $contact = Contact::find($id);

    return view('contactpoint.manage')
      ->with('contactpoint', $contactpoint)
      ->with('contact', $contact)
      ->with('action', 'store');
  }

  public function store(ContactpointRequest $request)
  {
    $contact = Contact::find($request->contactid);

    $request->validated();

    Contactpoint::create([
      'contactPerson' => $request->contactid,
      'dateOfContact' => $request->dateOfContact,
      'description' => $request->description,
    ]);

    return redirect()->route('contact.show', ['contact' => $contact]);
  }

  public function show(Contactpoint $contactpoint, Contact $contact)
  {
    return view('contactpoint.manage')
      ->with('contactpoint', $contactpoint)
      ->with('contact', $contact)
      ->with('action', 'update');
  }

  public function edit(int $contactpointid)
  {
    $contactpoint = Contactpoint::find($contactpointid);

    $contact = Contact::find($contactpoint->contactPerson);

    return view('contactpoint.manage')
      ->with('contactpoint', $contactpoint)
      ->with('contact', $contact)
      ->with('action', 'update');
  }

  public function update(ContactpointRequest $request, Contactpoint $contactpoint)
  {
    $request->validated();

    $contact = Contact::find($contactpoint->contactPerson);

    $contactpoint->update($request->all());

    return redirect()->route('contact.show', ['contact' => $contact]);
  }

  public function destroy(int $contactpointid)
  {
    $contactpoint = Contactpoint::find($contactpointid);
    $contact = Contact::find($contactpoint->contactPerson);

    $contactpoint->delete();

    return redirect()->route('contact.show', ['contact' => $contact]);
  }

  public function complete(Actionpoint $actionpoint)
  {
  }
}
