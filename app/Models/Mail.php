<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;
    protected $fillable=[
        'message_no',
        'message_id',
        'uuid',
        'subject',
        'to',
        'from',
        'text_body',
        'date',
        'folder_id',
    ];
}
