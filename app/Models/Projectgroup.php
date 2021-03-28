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
  protected $fillable = ['name'];
  protected $dates = ['deleted_at'];
}