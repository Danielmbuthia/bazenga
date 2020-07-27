<?php

namespace App\Http\Controllers;

use App\Insurance;
use App\User;
use App\User_Insurance;
use Illuminate\Http\Request;
use function Bazenga\get_dependants;

class InsuranceController extends Controller
{
    public function getAllInsurances(){
        try {
            $data = Insurance::all();
            $message = 'Insurance fetched';
        }catch (\Exception $e){
            $data = [];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function assignInsuranceToUser(Request $request){
        try {
            $request = $request->all();
            $users = User::find(get_dependants($request['user_id']));
            $count = 0;
            foreach ($users as $user){
                User_Insurance::create([
                    'user_id'=>$user['id'],
                    'insurance_id'=>$request['insurance_id'],
                    'limit'=>$request['limit'],
                    'balance'=>$request['limit']
                ]);
                $count++;
            }
            $data= [];
            if ($count>1){
                $message = $count .' user and dependants assigned insurance successfully';
            }else{
                $message ='user assigned insurance successfully';
            }
        }catch (\Exception $e){
            $data =[];
            $message = 'an error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function createInsurance(Request $request){
        try {
            $request = $request->all();
            $data = Insurance::create($request);
            $message = 'Insurance created successfully';
        }catch (\Exception $e){
            $data =[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function editInsurance(Request $request,$id){
        try {
            $request = $request->all();
            $insurance = Insurance::find($id);
            $insurance->update($request);
            $data = $insurance;
            $message='Insurance edited successfully';
        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
}
