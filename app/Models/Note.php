<?php

namespace App\Models;

use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\contact\Contact
 *
 * @property int $id
 * @property string $description
 * @property int $creator
 * @property int $contact
 * @property \Illuminate\Support\Carbon|null $creation
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @mixin \Eloquent
 */


class Note extends Model
{
    use HasFactory;

  protected $table = 'notes';

  protected $fillable = ['creation', 'description', 'creator', 'contact'];
  public $timestamps = false;
}
