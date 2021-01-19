<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendData extends Model
{
    const DataKeys = [
        'About Us'=>'about_us',
        'Contact us'=>'contact_us',
        'Zoom'=>'zoom_url'
    ];

    use HasFactory;

    protected $fillable=[
        'key',
        'data'
    ];

    protected $casts = ['data'];

    /*public function setDataAttribute($value)
    {
        return serialize($value);
    }*/

    public function getDataAttribute()
    {
        return json_decode($this->attributes['data'], true);
    }
}
