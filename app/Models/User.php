<?php

namespace App\Models;

use App\Traits\Encryptable;
use App\Notifications\MailResetPasswordNotification;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static role(string $string)
 * @method static where(string $string, string $string1, int $creator)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
  use HasFactory;
  use hasRoles;
  use Notifiable;
  use Encryptable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password'];

  protected $encryptable = ['name'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function isAdmin(): bool
  {
    foreach ($this->roles()->get() as $role) {
      if ($role->name == 'Admin') {
        return true;
      }
    }

    return false;
  }
  public function projectGroups(): BelongsToMany
  {
    return $this->belongsToMany(ProjectGroup::class);
  }

  public function classrooms(): BelongsToMany
  {
    return $this->belongsToMany(StudentClass::class);
  }

  public function Actionpoints(): BelongsToMany
  {
    return $this->belongsToMany(Actionpoint::class);
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new MailResetPasswordNotification($token));
  }
}
