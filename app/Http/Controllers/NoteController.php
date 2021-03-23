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
//    $newNote = new Note();
//    $newNote->description = $note->input('description');
//    $newNote->creator = Auth::user()->id;
//    $newNote->contact = $contact->id;
//
//    $newNote->save();

    return redirect()->route('contact.show', $contact);
  }
}
