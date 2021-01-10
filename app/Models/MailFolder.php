<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_fetch'
    ];
}
