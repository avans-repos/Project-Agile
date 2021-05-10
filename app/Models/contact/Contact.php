<?php

namespace App\Models\contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereInitials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereInsertion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhonenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
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
}
