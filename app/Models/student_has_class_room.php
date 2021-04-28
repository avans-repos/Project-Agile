<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\student_has_class_room
 *
 * @property int $student
 * @property int $name
 * @mixin \Eloquent
 * @method static where(string $string, string $string1, int $id)
 */
class student_has_class_room extends Model
{
    use HasFactory;
  protected $table = 'student_has_class_rooms';
  protected $fillable = ['student','class_room'];
  public $timestamps = false;

  public function student(){
    return User::whereId($this->student)->first();
  }
}
