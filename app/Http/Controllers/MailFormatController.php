<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailFormatRequest;
use App\Mail\TestEmail;
use App\Models\contact\Contact;
use App\Models\EmailTag;
use App\Models\Mail_format;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailFormatController extends Controller
{

  public function index()
  {
    $mailFormats = Mail_format::all();
    return view('mailformat.index')->with('mailFormats', $mailFormats);
  }

  public function mailSetup(){
    $mailFormats= Mail_format::all();
    $contacts = Contact::all();
    $tags = EmailTag::all();

    return view('mailformat.send')
      ->with('mailformats', $mailFormats)
      ->with('tags', $tags)
      ->with('contacts', $contacts);
  }

  public function sendMail(){
    $mail = Mail_format::all()->first();
    $body = $mail->getReplacedText(['voornaam' => 'Jaap', 'achternaam' => 'Rodenburg']);
    $data = ['message' => $body, 'replyTo' => Auth::user()->email, 'replyToName' => Auth::user()->name, 'subject' => $mail->name];

    Mail::to('jhpa.rodenburg@student.avans.nl')->send(new TestEmail($data));
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
    $mailformat->delete();
    return redirect()->route('mailformat.index');
  }
}
