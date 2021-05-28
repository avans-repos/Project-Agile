<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contact\Contact;

class Company_has_contacts extends Model
{
  use HasFactory;
  protected $table = 'company_has_contacts_has_contacttypes';
  protected $fillable = ['contact', 'company', 'contacttype'];

  public function contact()
  {
    return $this->hasOne(Contact::class, 'id');
  }

  public function company()
  {
    return $this->hasOne(Company::class, 'id');
  }
}
