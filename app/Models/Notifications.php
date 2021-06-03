<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
  use HasFactory;

  protected $table = 'notifications';
  protected $fillable = ['type', 'notifiable_id', 'data'];
  public $timestamps = true;
}
