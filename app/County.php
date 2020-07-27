<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable=[
        'name',
        'code'
    ];
     public function branch(){
        return $this->hasOne(County::class);
     }
}
