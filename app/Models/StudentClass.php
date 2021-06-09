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
  protected $fillable = ['name', 'year', 'schoolBlock'];
  protected $dates = ['deleted_at', 'created_at'];

  public function students(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }
  public function getDeleteText(): string
  {
    $text = '';
    $text .= 'Weet u zeker dat u "' . $this->name . '" wilt verwijderen<br>' ;

    $students = $this->students()->pluck('name');
    if (count($students) > 0) {
      $text .= '<br>Er zijn studenten die aan deze klas zijn gekoppeld: ';
      foreach ($students as $index => $student) {
        if ($index !== 0) {
          $text .= ',';
        }
        $text .= ' ' . $student;
      }
    }
    return $text;
  }
}
