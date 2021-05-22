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
    $address = 'janeexampexample@example.com';
    $name = 'Jane Doe';

    return $this->view('emails.test')
      ->from($address, $this->data['replyToName'])
      ->cc($address, $name)
      ->bcc($address, $name)
      ->replyTo($this->data['replyTo'], $this->data['replyToName'])
      ->subject($this->data['subject'])
      ->with([ 'test_message' => $this->data['message'] ]);
  }
}
