<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\EmailTag
 *
 * @property string $tag
 * @property string $description
 * @mixin Eloquent
 * @method static create(string[] $array)
 */

class EmailTag extends Model
{
    use HasFactory;
  public $timestamps = false; // removes the 'created_at' & 'updated_at' properties
  protected $fillable = ['tag', 'description'];
}
