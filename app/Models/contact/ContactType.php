<?php

namespace App\Models\contact;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\contact\ContactType
 *
 * @property string $name
 * @property string|null $description
 * @method static Builder|ContactType newModelQuery()
 * @method static Builder|ContactType newQuery()
 * @method static Builder|ContactType query()
 * @method static Builder|ContactType whereDescription($value)
 * @method static Builder|ContactType whereName($value)
 * @mixin Eloquent
 */
class ContactType extends Model
{
  use HasFactory;
}
