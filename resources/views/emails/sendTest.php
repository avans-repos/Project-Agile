<?php
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

$data = ['message' => 'This is a test!', 'replyTo' => 'jhpa.rodenburg@gmail.com', 'replyToName' => 'Jaap Rodenburg', 'subject' => 'Test'];

Mail::to('jhpa.rodenburg@student.avans.nl')->send(new TestEmail($data));
