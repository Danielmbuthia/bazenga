<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

define ('VERIFIED',  'VERIFIED');
define ('PENDING_VERIFICATION',  'PENDING_VERIFICATION');
define ('APPROVED',  'APPROVED');
define ('REJECTED',  'REJECTED');
class Claim extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_insurance_id',
        'diagnosis',
        'date',
        'doctor_id',
        'amount',
        'status'
    ];

}
