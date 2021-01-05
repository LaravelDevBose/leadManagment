<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable=[
        'mail_tos',
        'mail_ccs',
        'mail_subject',
        'mail_body',
        'sender_id',
        'mail_attachments'
    ];

    protected $appends=['send_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function getMailTosAttribute()
    {
        return json_decode($this->attributes['mail_tos']);
    }

    public function getMailAttachmentsAttribute()
    {
        return json_decode($this->attributes['mail_attachments'], true);
    }

    public function getMailCcsAttribute()
    {
        return json_decode($this->attributes['mail_ccs']);
    }

    public function getSendAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function scopeSearchBy($query, $request)
    {
        $searchKey = $request->search_key;
        if(!empty($searchKey)){
            $query = $query->where(function ($q) use ($searchKey){
                return $q->orWhere('mail_tos', 'LIKE', '%'. $searchKey .'%')
                    ->orWhere('mail_ccs', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('mail_subject', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('mail_body', 'LIKE', '%'. $searchKey. '%');
            });
        }

        return $query;
    }
}
