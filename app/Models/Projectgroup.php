<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projectgroup extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'projectgroups';
  protected $primaryKey = 'id';
  protected $fillable = ['name', 'project'];
  protected $dates = ['deleted_at'];
}
