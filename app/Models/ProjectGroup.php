<?php

namespace App\Models;

use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectGroup extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $primaryKey = 'id';
  protected $fillable = ['name', 'project'];
  protected $dates = ['deleted_at'];

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function contacts(): BelongsToMany
  {
    return $this->belongsToMany(Contact::class);
  }
}
