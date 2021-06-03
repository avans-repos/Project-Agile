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
    return $this->hasMany(Projectgroup::class, 'project');
  }

  public function getDeleteText(): string
  {
    $projectgroups = $this->projectGroups()->pluck('name');
    $text = '';
    if (count($projectgroups) > 0) {
      $text = '<br>Er zijn projectgroepen die aan dit project zijn gekoppeld: ';
      foreach ($projectgroups as $index => $projectgroup) {
        if ($index !== 0) {
          $text .= ',';
        }
        $text .= ' ' . $projectgroup;
      }
    }
    return $text;
  }
  public function projectGroups()
  {
    return $this->hasMany(ProjectGroup::class, 'project');
  }
}
