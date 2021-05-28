<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'companies';
  protected $fillable = ['name', 'phonenumber', 'email', 'size', 'website', 'visiting_address', 'mailing_address'];
  protected $dates = ['deleted_at'];

  public function contacts()
  {
    return $this->hasMany(Company_has_contacts::class, 'company');
  }
}
