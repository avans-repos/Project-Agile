<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\ClassRoom
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class ClassRoom extends Model
{
    use HasFactory;
  protected $table = 'class_rooms';
  protected $fillable = ['name'];
  protected $dates = ['deleted_at', 'created_at'];

  public function students()
  {
    return $this->belongsToMany(student_has_class_room::class);
  }
}
