<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_format extends Model
{
  use HasFactory;
  use Encryptable;
  protected $table = 'mail_formats';
  protected $fillable = ['name', 'body'];
  protected $encryptable = ['name', 'body'];

  public function getDeleteText(): string
  {
    return 'Weet u zeker dat u "' . e($this->name) . '" wilt verwijderen<br>';
  }
}
