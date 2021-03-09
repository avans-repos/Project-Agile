<?php

namespace App\Models\contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['initials','firstname','insertion','lastname','gender','email','phonenumber','type'];
}
