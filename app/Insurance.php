<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable =[
        'name',
        'hospital_id'
    ];
    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id');
    }
}
