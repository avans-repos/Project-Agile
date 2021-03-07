<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actionpoint extends Model
{
    protected  $fillable = [
        'Deadline',
        'Titel',
        'Description',
        'Finished',
        'ReminderDate'
    ];
}
