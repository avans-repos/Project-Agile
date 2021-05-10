<?php

namespace App\Models\contact;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\contact\Gender
 *
 * @property string $type
 * @method static Builder|Gender newModelQuery()
 * @method static Builder|Gender newQuery()
 * @method static Builder|Gender query()
 * @method static Builder|Gender whereType($value)
 * @mixin Eloquent
 */
class Gender extends Model
{
  use HasFactory;
}
