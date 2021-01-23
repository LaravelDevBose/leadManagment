<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    const Steps = [
        'Documentation'=>1,
        'Vehicle'=>2,
        'Payment'=>3,
        'Special'=>4,
    ];

    const Status = [
        'Open'=>1,
        'Closed'=> 2
    ];

    protected $table='leads';
    protected $primaryKey='lead_id';

    protected $fillable = [
        'current_step',
        'first_name',
        'last_name',
        'sec_client_first_name',
        'sec_client_last_name',
        'dealer_name',
        'phone_no',
        'email',
        'address',
        'city',
        'state',
        'postal_code',
        'vin_no',
        'year',
        'make',
        'model',
        'color',
        'mileage',
        'lein_holder_info',
        'trans_status',
        'trans_type',
        'trans_status_extra',
        'payment_type',
        'special_note',
        'lead_status',
        
        'payment_type_extra',
    ];

    protected $appends=['full_address', 'full_name'];
    protected static function booted()
    {
        static::deleted(function ($lead){
            $lead->logs()->delete();
        });
    }

    public function getFullAddressAttribute()
    {
        return $this->attributes['address'].','.$this->attributes['city']. ','. $this->attributes['state'].'-'.$this->attributes['postal_code'];
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i A');
    }
    public function getTransStatusExtraAttribute()
    {
        return json_decode($this->attributes['trans_status_extra'], true);
    }

    public function getPaymentTypeExtraAttribute()
    {
        return json_decode($this->attributes['payment_type_extra'], true);
    }

    public function scopeSearchBy($query, $request)
    {
        
        if (!empty($request->search_key)){
            
            $searchKey = $request->search_key;
            $query = $query->orWhereRaw("concat(first_name, ' ', last_name) like '%".$searchKey."%' ")
                    ->orWhere('first_name', 'LIKE', '%'. $searchKey .'%')
                    ->orWhere('last_name', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('dealer_name', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('vin_no', 'LIKE', '%'. $searchKey. '%');
        }
        return $query;
    }

    public function scopeIsOpen($query)
    {
        return $query->where('lead_status', self::Status['Open']);
    }

    public function scopeIsClosed($query)
    {
        return $query->where('lead_status', self::Status['Closed']);
    }

    public function logs()
    {
        return $this->hasMany(LeadLog::class, 'lead_id', 'lead_id')->latest();
    }
}
