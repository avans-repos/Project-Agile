<?php

namespace App\Models;

use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, mixed $id)
 * @property mixed project
 * * @method static Builder|ProjectGroup whereProject($value)
 */
class ProjectGroup extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $primaryKey = 'id';
  protected $fillable = ['name', 'project'];
  protected $dates = ['deleted_at'];

  public function projects()
  {
    return $this->belongsToMany(Project::class, 'projectgroup_project', 'projectgroupid', 'projectid');
  }

  public function getDeleteText(): string
  {
    $project = $this->projects()->pluck('name');
    $text = '';
    if ($project !== null) {
      $text .= '<br>Er is een project aan deze projectgroep gekoppeld: ';
      $text .= ' ' . $project;
    }
    $students = $this->users()->pluck('name');
    if (count($students) > 0) {
      $text .= '<br>Er zijn studenten/docenten die aan deze projectgroep zijn gekoppeld: ';
      foreach ($students as $index => $student) {
        if ($index !== 0) {
          $text .= ',';
        }
        $text .= ' ' . $student;
      }
    }
    return $text;
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function contacts(): BelongsToMany
  {
    return $this->belongsToMany(Contact::class);
  }

  public function project()
  {
    return $this->belongsTo(Project::class);
  }
}
