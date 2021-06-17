<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  use HasFactory;
  use Encryptable;

  protected $fillable = ['streetname', 'number', 'addition', 'zipcode', 'city', 'country'];
  protected $encryptable = ['streetname', 'number', 'addition', 'zipcode', 'city', 'country'];
}
