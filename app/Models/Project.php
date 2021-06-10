<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static find(mixed $project)
 */
class Project extends Model
{
  use HasFactory;

  protected $table = 'projects';
  protected $fillable = ['name', 'description', 'deadline', 'notes'];

  public function projectgroups()
  {
    return $this->hasMany(ProjectGroup::class, 'project');
  }

  public function getDeleteText(): string
  {
    $text = 'Weet u zeker dat u "' . $this->name . '" wilt verwijderen<br>';

    $projectgroups = $this->projectGroups()->pluck('name');
    if (count($projectgroups) > 0) {
      $text .= '<br>Er zijn projectgroepen die aan dit project zijn gekoppeld: ';
      foreach ($projectgroups as $index => $projectgroup) {
        if ($index !== 0) {
          $text .= ',';
        }
        $text .= ' ' . $projectgroup;
      }
    }
    return $text;
  }
}
