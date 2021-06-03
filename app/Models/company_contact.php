<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contact\Contact;

class company_contact extends Model
{
  use HasFactory;
  protected $fillable = ['contact_id', 'company_id', 'contacttype', 'added'];
  public $timestamps = false;

  public function contact()
  {
    return $this->belongsTo(Contact::class);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
