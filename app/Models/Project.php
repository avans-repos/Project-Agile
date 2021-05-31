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
}
