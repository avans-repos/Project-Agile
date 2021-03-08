<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actionpoint extends Model
{
    use HasFactory;

    public $timestamps = false;     // removes the 'created_at' & 'updated_at' properties

    protected  $fillable = [
        'Deadline',
        'Title',
        'Description',
        'Finished',
        'ReminderDate',
        'Creator'
    ];
}
