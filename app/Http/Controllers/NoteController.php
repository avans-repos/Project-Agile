<?php

namespace App\Http\Controllers;

use App\Events\NoteAdded;
use App\Http\Requests\NoteRequest;
use App\Models\contact\Contact;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
  public function create(Contact $contact)
  {
    return view('note.manage')
      ->with('contact', $contact)
      ->with('action', 'store')
      ->with('notification', null)
      ->with('note', new Note());
  }

  public function insert(Contact $contact, NoteRequest $note)
  {
    $databaseNote = Note::create(['description' => $note->input('description'), 'creator' => Auth::user()->id, 'contact' => $contact->id]);
    if ($note->reminder != null && $note->reminder == 1) {
      $notificationData = [
        'reminderdate' => $note->reminderdate,
        'noteId' => $databaseNote->id,
        'description' => $note->reminderDescription,
        'user' => Auth::user(),
        'contactId' => $contact->id,
      ];
      event(new noteAdded($notificationData));
    }
    return redirect()->route('contact.show', $contact);
  }

  public function update(Note $note, NoteRequest $noteRequest)
  {
    $note->description = $noteRequest->input('description');
    $note->update($noteRequest->all());

    DB::table('notifications')
      ->where('data->note_id', $note->id)
      ->delete();

    if ($note->reminder != null && $note->reminder == 1) {
      $notificationData = [
        'reminderdate' => $noteRequest->reminderdate,
        'noteId' => $note->id,
        'description' => $noteRequest->reminderDescription,
        'user' => Auth::user(),
        'contactId' => $note->contact,
      ];

      event(new noteAdded($notificationData));
    }

    $contact = Contact::whereId($note->contact)->first();
    return redirect()->route('contact.show', $contact);
  }

  public function edit(Note $note)
  {
    $contact = Contact::whereId($note->contact)->first();
    $notification = DB::table('notifications')
      ->where('data->note_id', $note->id)
      ->first();

    if ($notification != null) {
      $notification->data = json_decode($notification->data, true);
    }

    return view('note.manage')
      ->with('note', $note)
      ->with('contact', $contact)
      ->with('notification', $notification)
      ->with('action', 'update');
  }

  public function delete(Note $note)
  {
    $contact = Contact::whereId($note->contact)->first();
    $note->delete();
    return redirect()->route('contact.show', $contact);
  }
}
