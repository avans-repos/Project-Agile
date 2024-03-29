<?php

namespace App\Models;

use App\Traits\Encryptable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Actionpoint
 *
 * @property int $id
 * @property int $contactPerson
 * @property string $dateOfContact
 * @property string $description
 * @mixin Eloquent
 */
class Contactpoint extends Model
{
  use HasFactory;
  use Encryptable;

  public $timestamps = false; // removes the 'created_at' & 'updated_at' properties

  protected $fillable = ['contactPerson', 'dateOfContact', 'description'];
  protected $encryptable = ['description'];
}
