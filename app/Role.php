<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable =['name'];
    public function user(){
        return $this->hasOne(User::class);
    }
}
