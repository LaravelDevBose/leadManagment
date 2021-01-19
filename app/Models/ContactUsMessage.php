<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsMessage extends Model
{
    use HasFactory;
    protected $table='contact_us_messages';

    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'phone_no',
        'message'
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M y h:i A');
    }
}
