<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable =[
        'name',
        'logo'
    ];
    protected $with=['branches','insurances'];


    public function branches(){
        return $this->hasMany(Branch::class);
    }
    public function insurances(){
        return $this->hasMany(Insurance::class);
    }
}
