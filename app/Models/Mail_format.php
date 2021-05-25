<?php

namespace App\Models;

use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_format extends Model
{
  use HasFactory;
  protected $table = 'mail_formats';
  protected $fillable = ['name', 'body'];

  public function getReplacedText(array $information)
  {
    $text = $this->body;
    foreach ($information as $key => $value) {
      $replace = '{' . $key . '}';
      $text = str_replace($replace, $value, $text);
    }
    return $text;
  }
}
