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
        'Special'=>4
    ];

    const Status = [
        'Open'=>1,
        'Closed'=> 2
    ];

    protected $table='leads';
    protected $primaryKey='lead_id';

    protected $fillable = [
        'current_step',
        'full_name',
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
        'payment_type',
        'special_note',
        'lead_status'
    ];

    protected $appends=['full_address'];

    public function getFullAddressAttribute()
    {
        return $this->attributes['address'].','.$this->attributes['city']. ','. $this->attributes['state'].'-'.$this->attributes['postal_code'];
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i A');
    }

    public function scopeSearchBy($query, $request)
    {
        if (!empty($request->search_key)){
            $searchKey = $request->search_key;
            $query = $query->where(function ($q) use ($searchKey){
                return $q->orWhere('full_name', 'LIKE', '%'. $searchKey .'%')
                    ->orWhere('phone_no', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('email', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('address', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('city', 'LIKE', '%'. $searchKey. '%')
                    ->orWhere('state', 'LIKE', '%'. $searchKey. '%');
            });
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
}
