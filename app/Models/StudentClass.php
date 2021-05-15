<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\ClassRoom
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property int $schoolBlock
 * @mixin Eloquent
 * @method static create(array $all)
 */
class StudentClass extends Model
{
  use HasFactory;
  protected $table = 'class_rooms';
  protected $fillable = ['name', 'year', 'schoolBlock'];
  protected $dates = ['deleted_at', 'created_at'];

  public function students(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }
}
