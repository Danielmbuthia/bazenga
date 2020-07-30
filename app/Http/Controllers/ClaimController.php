<?php

namespace App\Http\Controllers;

use App\Claim;
use App\User;
use App\User_Insurance;
use Illuminate\Http\Request;
use function Bazenga\format_phone;
use function Bazenga\generateRandomCode;
use function Bazenga\sendMessage;

class ClaimController extends Controller
{
    public function fetchAllClaims(){
        try {
            $data = Claim::all();
            $message = ' Insurance claims fetched successfully';
        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }

    public function createAClaim(Request $request){
        try {
            $request =$request->all();
            $user_insurance = User_Insurance::where('user_id',$request['user_id'])->where('insurance_id',$request['insurance_id'])->get();
            if ($user_insurance){
                $claimData = [
                    'user_insurance_id'=>$user_insurance['id'],
                    'diagnosis'=>$request['diagnosis'],
                    'date'=>$request['date'],
                    'amount'=>$request['amount'],
                    'status'=>PENDING_VERIFICATION,
                    'doctor_id'=>auth()->user()->id
                ];
               $data= Claim::create($claimData);
                $message = 'Claim recorded successfully';
                $user = User::find($request['user_id']);
                if ($user){
                    $phone = format_phone($user['mobile'],'KE');
                    $code = generateRandomCode(); // send otp
                    $user->otp = $code;
                    $user->save();
                    sendMessage($phone,'You verification code is: '.$code);
                }
            }else{
                $data=[];
                $message='User insurance not found ';
            }
        }catch (\Exception $e){
             $data=[];
             $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function verifyClaimOTP(Request $request){
        try {
            $request = $request->all();
            $user = User::find($request['user_id']);
            $claim = Claim::find($request['claim_id']);
            if ($request['code'] == $user['otp']){
                $claim->status = VERIFIED;
                $user->otp=null;
                $user->save();
                $claim->save();
                $message='Claim verified successfully';
            }else{
                $message = 'Incorrect code ';
            }
            $data = $claim;
        }catch (\Exception $e){
            $data = [];
            $message = 'An error occurred please try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function approveRejectClaim(Request $request,$id){
        try {
            $request = $request->all();
            $claim = Claim::find($id);
            $user_insurance = User_Insurance::where('user_id',$claim['user_id'])->where('insurance_id',$claim['insurance_id'])->get();
            if (!$user_insurance && is_null($user_insurance)){
                return response()->json(['data'=>[],'message'=>'User is not assigned this insurance']);
            }
            if ($claim['amount'] > $user_insurance['balance']){
                $claim->status=REJECTED;
                $claim->save();
                return response()->json(['data'=>[],'message'=>'Claim balance is lower than requested amount']);
            }
            if ($request['action'] == 'APPROVE'){
                $claim->status = APPROVED;
                $claim->save();
                $user_insurance->balance = $user_insurance['balance'] - $claim['amount'];
                $user_insurance->save();
                $message = 'Claim approved successfully';
            }else if($request['action'] == 'REJECT'){
                $claim->status=REJECTED;
                $claim->save();
                $message='Claim rejected successfully';
            }else{
                 $message ='No action sent';
            }
            $data = $claim;
        }catch (\Exception $e){
            $data=[];
            $message='An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }


}
