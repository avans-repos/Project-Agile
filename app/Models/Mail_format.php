<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_format extends Model
{
    use HasFactory;
    protected $table = 'mail_formats';
    protected $fillable = ['name', 'body'];
}
