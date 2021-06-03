<?php

namespace App\Models;

use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'companies';
  protected $fillable = ['name', 'phonenumber', 'email', 'size', 'website', 'note', 'visiting_address', 'mailing_address'];
  protected $dates = ['deleted_at'];

  public function contacts()
  {
    return $this->hasMany(company_contact::class);
  }

  public function visiting_address()
  {
    return $this->hasOne(Address::class, 'id', 'visiting_address')->first();
  }

  public function mailing_address()
  {
    return $this->hasOne(Address::class, 'id', 'mailing_address')->first();
  }
}
