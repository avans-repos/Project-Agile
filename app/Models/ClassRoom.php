<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\ClassRoom
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @mixin \Eloquent
 */
class ClassRoom extends Model
{
    use HasFactory;
  protected $table = 'class_rooms';
  protected $fillable = ['name', 'year'];
  protected $dates = ['deleted_at', 'created_at'];

  public function students()
  {
    return student_has_class_room::where('class_room' , '=', $this->id)->get();
  }
}
