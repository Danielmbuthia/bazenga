<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with=[
        'role'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'sur_name',
        'username',
        'email',
        'password',
        'mobile',
        'otp',
        'role_id',
        'dependant_id',
        'relationship'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
//    public function dependants(){
//        return $this->hasMany(MemberDependant::class,'dependant_id');
//    }
    function userDependantId(){
        if ($this->dependant_id==null && is_null($this->dependant_id)){
            $user_id= $this->id;
        }else{
            $user_id = $this->dependant_id;
        }
        return $user_id;
    }
    function allDependants(){
        $user_id = $this->userDependantId();
        $dependantsIDS = User::where('dependant_id',$user_id)->pluck('id')->toArray();
        if (!in_array($this->id,$dependantsIDS)){
            array_push($dependantsIDS,$this->id);
        }
        if (!in_array($user_id,$dependantsIDS)){
            array_push($dependantsIDS,$user_id);
        }
        return $dependantsIDS;
    }
    public function insurances(){
        return User_Insurance::whereIn('user_id',$this->allDependants());
    }
    public function countDependant(){
        return count($this->allDependants());
    }
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

}
