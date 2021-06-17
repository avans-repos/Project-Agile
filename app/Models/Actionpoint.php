<?php

namespace App\Models;

use App\Traits\Encryptable;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @mixin Eloquent
 * @method static where(string $string, int $id)
 */
class Actionpoint extends Model
{
  use HasFactory;
  use Encryptable;

  public $timestamps = false; // removes the 'created_at' & 'updated_at' properties

  protected $fillable = ['deadline', 'title', 'description', 'finished', 'reminderdate', 'creator'];
  protected $encryptable = ['title', 'description'];

  public function teachers(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }
  public function creator()
  {
    return $this->belongsTo(User::class, 'creator', 'id');
  }
  public function getDeleteText(): string
  {
    return 'Weet u zeker dat u "' . e($this->title) . '" wilt verwijderen<br>';
  }
}
