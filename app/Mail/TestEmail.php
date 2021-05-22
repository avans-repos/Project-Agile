<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
  use Queueable;
  use SerializesModels;

  public $data;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('emails.base')
      ->from(env('MAIL_FROM_ADDRESS'), $this->data['replyToName'])
      ->replyTo($this->data['replyTo'], $this->data['replyToName'])
      ->subject($this->data['subject'])
      ->with(['test_message' => nl2br($this->data['message'])]);
  }
}
