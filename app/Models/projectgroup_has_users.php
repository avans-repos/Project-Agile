<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\student_has_class_room
 *
 * @property int $userid
 * @property int $projectgroupid
 * @mixin Eloquent
 */
class projectgroup_has_users extends Model
{
  use HasFactory;
  protected $table = 'projectgroup_has_users';
  protected $fillable = ['userid', 'projectgroupid'];
  public $timestamps = false;
}
