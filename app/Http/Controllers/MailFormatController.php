<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailFormatRequest;
use App\Mail\TestEmail;
use App\Models\contact\Contact;
use App\Models\Mail_format;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailFormatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $mail = Mail_format::all()->first();
    $body = $mail->getReplacedText(['voornaam' => 'Jaap', 'achternaam' => 'Rodenburg']);
    $data = ['message' => $body, 'replyTo' => Auth::user()->email, 'replyToName' => Auth::user()->name, 'subject' => $mail->name];

    Mail::to('jhpa.rodenburg@student.avans.nl')->send(new TestEmail($data));

    $mailFormats = Mail_format::all();
    return view('mailformat.index')->with('mailFormats', $mailFormats);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $mailformat = new Mail_format();
    return view('mailformat.manage')
      ->with('mailformat', $mailformat)
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

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Mail_format  $mail_format
   * @return \Illuminate\Http\Response
   */
  public function edit(Mail_format $mailformat)
  {
    return view('mailformat.manage')
      ->with('mailformat', $mailformat)
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
