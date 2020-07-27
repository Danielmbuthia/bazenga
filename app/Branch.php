<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable=[
        'name',
        'hospital_id',
        'county_id',
        'address',
        'mobile'
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id');
    }
    public function county(){
        return $this->belongsTo(County::class,'county_id');
    }
}
