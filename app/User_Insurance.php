<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class User_Insurance extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'user_insurances';
    protected $fillable=[
        'insurance_id',
        'user_id',
        'limit',
        'balance'
    ];
}
