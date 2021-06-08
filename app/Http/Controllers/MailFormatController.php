<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailFormatRequest;
use App\Http\Requests\SendMailRequest;
use App\Mail\BaseEmail;
use App\Models\contact\Contact;
use App\Models\EmailTag;
use App\Models\Mail_format;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class MailFormatController extends Controller
{
  public function index()
  {
    $mailFormats = Mail_format::all();
    return view('mailformat.index')->with('mailFormats', $mailFormats);
  }

  public function mailSetup()
  {
    $mailFormats = Mail_format::all();
    $contacts = Contact::all();
    $tags = EmailTag::all();

    return view('mailformat.send')
      ->with('mailformats', $mailFormats)
      ->with('tags', $tags)
      ->with('contacts', $contacts);
  }

  public function sendMail(SendMailRequest $request)
  {
    $request->validate([
      'contact' => 'required',
    ]);

    $contactIds = $request->get('contact');
    foreach ($contactIds as $contactId) {
      // Do not break for each loop if one email fails
      try {
        $contact = Contact::whereId($contactId)->first();
        if ($contact != null && $contact->email != null) {
          $body = $this->getReplacedText($request->get('body'), [
            'voornaam' => $contact->firstname,
            'achternaam' => $contact->lastname,
            'datum' => Carbon::now()->format('Y-m-d'),
          ]);
          $subject = $this->getReplacedText($request->get('name'), [
            'voornaam' => $contact->firstname,
            'achternaam' => $contact->lastname,
            'datum' => Carbon::now()->format('Y-m-d'),
          ]);
          $data = ['message' => $body, 'replyTo' => Auth::user()->email, 'replyToName' => Auth::user()->name, 'subject' => $subject];
          Mail::to($contact->email)->queue(new BaseEmail($data));
        }
      } catch (Exception $e) {
      }
    }
    return redirect(route('dashboard'));
  }

  public function create()
  {
    $mailformat = new Mail_format();
    $tags = EmailTag::all();

    return view('mailformat.manage')
      ->with('mailformat', $mailformat)
      ->with('tags', $tags)
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(MailFormatRequest $request)
  {
    $request->validated();
    Mail_format::create($request->all());

    return redirect()->route('mailformat.index');
  }

  public function edit(Mail_format $mailformat)
  {
    $tags = EmailTag::all();
    return view('mailformat.manage')
      ->with('mailformat', $mailformat)
      ->with('tags', $tags)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Mail_format  $mail_format
   * @return \Illuminate\Http\Response
   */
  public function update(MailFormatRequest $request, Mail_format $mailformat)
  {
    $request->validated();
    $mailformat->update($request->all());
    return redirect()->route('mailformat.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Mail_format  $mail_format
   * @return \Illuminate\Http\Response
   */
  public function destroy(Mail_format $mailformat)
  {
    if (Auth::user()->isAdmin()) {
      $mailformat->delete();
    }
    return redirect()->route('mailformat.index');
  }

  public function getReplacedText(string $text, array $information)
  {
    foreach ($information as $key => $value) {
      $replace = '{' . $key . '}';
      $text = str_replace($replace, $value, $text);
    }
    return $text;
  }
}
