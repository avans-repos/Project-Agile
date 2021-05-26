<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\teacher_has_actionpoints
 *
 * @property int $userid
 * @property int $actionpointid
 * @mixin Eloquent
 */
class teacher_has_actionpoints extends Model
{
  use HasFactory;
  protected $table = 'teacher_has_actionpoints';
  protected $fillable = ['userid', 'actionpointid'];
  public $timestamps = false;
}
