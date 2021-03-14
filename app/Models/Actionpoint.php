<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

/**
 * App\Models\Actionpoint
 *
 * @property int $id
 * @property string $deadline
 * @property string $title
 * @property string $description
 * @property string|null $finished
 * @property string|null $reminderdate
 * @property int $creator
 * @mixin \Eloquent
 */
class Actionpoint extends Model
{
  use HasFactory;

  public $timestamps = false; // removes the 'created_at' & 'updated_at' properties

  protected $fillable = ['deadline', 'title', 'description', 'finished', 'reminderdate', 'creator'];
}
