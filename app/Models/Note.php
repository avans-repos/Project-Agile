<?php

namespace App\Models;

use App\Models\contact\Contact;
use App\Traits\Encryptable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\contact\Contact
 *
 * @property int $id
 * @property string $description
 * @property int $creator
 * @property int $contact
 * @property Carbon|null $creation
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereCreation($value)
 * @method static Builder|Contact whereCreator($value)
 * @method static Builder|Contact whereContact($value)
 * @method static Builder|Contact whereId($value)
 * @mixin Eloquent
 */

class Note extends Model
{
  use HasFactory;
  use Encryptable;

  protected $table = 'notes';

  protected $fillable = ['creation', 'description', 'creator', 'contact'];
  protected $encryptable = ['description'];
  public $timestamps = false;

  public function contact()
  {
    return $this->hasOne(Contact::class, 'id', 'contact');
  }
  public function creator()
  {
    return $this->hasOne(User::class, 'id', 'creator');
  }
}
