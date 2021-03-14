<?php

namespace App\Models\contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\contact\ContactType
 *
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereName($value)
 * @mixin \Eloquent
 */
class ContactType extends Model
{
  use HasFactory;
}
