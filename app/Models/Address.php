<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Address extends Model
{
  use HasFactory;

  protected $fillable = ['streetname', 'number', 'addition', 'zipcode', 'city', 'country'];
}
