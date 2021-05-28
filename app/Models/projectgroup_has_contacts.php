<?php

namespace App\Models;

use App\Models\contact\Contact;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\projectgroup_has_contacts
 *
 * @property int $contactid
 * @property int $projectgroupid
 * @mixin Eloquent
 */
class projectgroup_has_contacts extends Model
{
  use HasFactory;
  protected $table = 'projectgroup_has_contacts';
  protected $fillable = ['contactid', 'projectgroupid'];
  public $timestamps = false;

  public function contact()
  {
    return $this->hasOne(Contact::class, 'id')->withDefault();
  }

  public function project() {

    return $this->hasOne(Projectgroup::class, 'id')->withDefault();
  }
}
