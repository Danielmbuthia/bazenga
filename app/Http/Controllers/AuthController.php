<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Bazenga\get_dependants;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;
    public function register(Request $request)
    {
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name'=>$request['first_name'],
                'last_name'=>$request['last_name'],
                'sur_name'=>$request['surname'],
                'username'=>$request['username'],
                'mobile'=>$request['mobile'],
                'role_id'=>$request['role_id'],
            ]);
            $token = auth()->login($user);
            $data = auth()->user();
            return $this->respondWithToken($token,$data);
        }catch (\Exception $e){
            return response()->json(['data'=>[],'message'=>''.$e->getMessage()],401);
        }
    }

    public function login(){
        try {
            $credentials = request(['username', 'password']);
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $data = auth()->user();
            return $this->respondWithToken($token,$data);
        }catch (\Exception $e){
            return response()->json(['data'=>[],'message'=>''.$e->getMessage()],401);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(['message' => 'Successfully logged out','data'=>[]]);
        }catch (\Exception $e){
            return response()->json(['data'=>[],'message'=>''.$e->getMessage()],401);
        }
    }
    public function getAuthUser(Request $request)
    {
        try {
            return response()->json(['data'=>auth()->user(),'message'=>'User fetched']);
        }catch (\Exception $e){
            return response()->json(['data'=>[],'message'=>''.$e->getMessage()],401);
        }
    }
    protected function respondWithToken($token,$data=null){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
             'data'=>$data
        ]);
    }

    public function addDependants(Request $request){
        try {
            $request = $request->all();
            $user = User::find($request['user_id']);
            if ($user->countDependant() >= 6){
                return response()->json(['data'=>[],'message'=>'Maximum dependants added. Can not add any other dependant']);
            }
            $dependant_data = [
                'first_name'=>$request['first_name'],
                'last_name'=>$request['last_name'],
                'sur_name'=>$request['sur_name'],
                'username'=>$request['first_name'].$request['sur_name'],
                'email'=>isset($request['email']) ? $request['email']:null,
                'password'=>bcrypt('password'),
                'dependant_id'=>$user['id'],
                'relationship'=>$request['relationship'],
                'mobile'=>isset($request['mobile']) ? $request['mobile']:null
            ];
           $dependant= User::create($dependant_data);
            $data = $dependant;
            $message = 'dependant added successfully';
        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
}
