<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactpointRequest;
use App\Models\contact\Contact;
use App\Models\Contactpoint;
use App\Models\User;
use App\Service\AuthenticationService;
use DateTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    if(Auth::user()->isAdmin()) {
      $contactpoint->delete();
    }

    return redirect()->route('contact.show', ['contact' => $contact]);
  }

  public function complete(Actionpoint $actionpoint)
  {
  }
}
