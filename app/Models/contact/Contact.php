<?php

namespace App\Models\contact;

use App\Models\Company_has_contacts;
use App\Models\ProjectGroup;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\contact\Contact
 *
 * @property int $id
 * @property string $initials
 * @property string $firstname
 * @property string|null $insertion
 * @property string $lastname
 * @property string $gender
 * @property string|null $email
 * @property string|null $phonenumber
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereEmail($value)
 * @method static Builder|Contact whereFirstname($value)
 * @method static Builder|Contact whereGender($value)
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereInitials($value)
 * @method static Builder|Contact whereInsertion($value)
 * @method static Builder|Contact whereLastname($value)
 * @method static Builder|Contact wherePhonenumber($value)
 * @method static Builder|Contact whereType($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Contact extends Model
{
  use HasFactory;

  protected $fillable = ['initials', 'firstname', 'insertion', 'lastname', 'gender', 'email', 'phonenumber', 'type', 'address'];

  public function getName(): string
  {
    $fullname = $this->firstname . ' ';
    if (isset($this->insertion)) {
      $fullname .= $this->insertion . ' ';
    }
    $fullname .= $this->lastname;

    return $fullname;
  }

  public function companies()
  {
    return $this->hasMany(Company_has_contacts::class, 'contact');
  }

  public function projectGroups(): BelongsToMany
  {
    return $this->belongsToMany(ProjectGroup::class);
  }
}
