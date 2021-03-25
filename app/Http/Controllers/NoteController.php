<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Actionpoint;
use App\Models\contact\Contact;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
  public function create(Contact $contact)
  {
    return view('note.manage')
      ->with('contact', $contact)
      ->with('action', 'store')
      ->with('note', new Note());
  }
  public function insert(Contact $contact, NoteRequest $note){
    Note::create(['description' => $note->input('description'), 'creator' => Auth::user()->id, 'contact' =>  $contact->id]);

    return redirect()->route('contact.show', $contact);
  }

  public function update(Note $note, NoteRequest $noteRequest){
  $note->description = $noteRequest->input('description');
  $note->update($noteRequest->all());

  $contact = Contact::whereId($note->contact)->first();
  return redirect()->route('contact.show', $contact);
  }

  public function edit(Note $note){
    $contact = Contact::whereId($note->contact)->first();
    return view('note.manage')
      ->with('note', $note)
      ->with('contact', $contact)
      ->with('action', 'update');
  }

  public function delete(Note $note){
    $contact = Contact::whereId($note->contact)->first();
    $note->delete();
    return redirect()->route('contact.show', $contact);
  }
}
