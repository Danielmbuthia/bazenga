<?php
namespace Bazenga;




use AfricasTalking\SDK\AfricasTalking;
use App\User;
use Propaganistas\LaravelPhone\PhoneNumber;

function format_phone($no, $country){
    try{
        if(strlen($no) > 0){
            $no = substr($no,-9);
        }
        $mobile=PhoneNumber::make($no,$country)->formatInternational();
        $mobile=str_replace("+",'',str_replace(" ",'',$mobile));
    }catch (\Exception $exc){
        return $no;
    }
    return $mobile;
}
function sendMessage($number,$message){
    $username = env("AFRICA_USERNAME");
    $apiKey   = env("AFRICA_API_KEY");
    $AT       = new AfricasTalking($username, $apiKey);
    $sms      = $AT->sms();
    $result   = $sms->send([
        'to'      => $number,
        'message' => $message
    ]);
    return $result;

}

function get_dependants($user_id=null){
    if ($user_id==null){
        $user = auth()->user();
    }else{
        $user = User::find($user_id);
    }
    if (!$user){
        return [];
    }else{
        return $user->get_dependants();
    }
}

function generateRandomCode(){
    return mt_rand(1000000,999999);
}
