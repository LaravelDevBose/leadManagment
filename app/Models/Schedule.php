<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table='schedules';
    protected $primaryKey='id';

    protected $fillable=[
        'title',
        'start',
        'end',
        'state',
        'isAllday',
    ];

    protected $appends=['calendarId', 'color', 'bgColor', 'borderColor'];

    public function getCalendarIdAttribute()
    {
        return 2;
    }

    public function getColorAttribute()
    {
        return '#ffffff';
    }

    public function getBgColorAttribute()
    {
        return '#827af3';
    }

    public function getBorderColorAttribute()
    {
        return '#827af3';
    }

    public function getStartAttribute()
    {
        return date('Y-m-d\TH:i:sP', strtotime($this->attributes['start']));
    }

    public function getEndAttribute()
    {
        return date('Y-m-d\TH:i:sP', strtotime($this->attributes['end']));
    }
    public function getIsAllDayAttribute()
    {
        return $this->attributes['isAllday'] ==1;
    }

}
