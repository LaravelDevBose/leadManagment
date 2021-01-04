<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttendance extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'date',
        'login_time',
        'logout_time',
        'login_ip',
        'logout_ip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d M Y');
    }

    public function getLoginTimeAttribute()
    {
        return Carbon::parse($this->attributes['login_time'])->format('h:i A');
    }

    public function getLogoutTimeAttribute()
    {
        return Carbon::parse($this->attributes['logout_time'])->format('h:i A');
    }

    public function scopeSearchBy($query, $request)
    {
        if (!empty($request->start)){
            $query = $query->whereDate('date', '>=', $request->start);
        }else{
            $query = $query->whereDate('date', '>=', Carbon::today()->subDays(30));
        }

        if (!empty($request->end)){
            $query = $query->whereDate('date', '<=', $request->end);
        }else{
            $query = $query->whereDate('date', '<=', Carbon::today());
        }

        return $query;
    }
}
