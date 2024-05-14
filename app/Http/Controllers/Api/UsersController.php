<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'status'=>'active'])) {
            $user = Auth::user();
            $userRole = $user->roles->pluck('name','name')->first();
            if($userRole=='Admin'){
                // var_dump($userRole); die;
                $data = User::where('id', $user->id)->first();
                $data->is_online = '1';
                $data->save();
                $data['api_token'] = $user->createToken('auth_token')->plainTextToken;
                $this->data = $data;
                $this->responsee(true);
            }else{
                $this->d_err = 'These credentials do not match our records.';
                $this->responsee(false, $this->d_err);
            }
        } else {
            $this->d_err = 'These credentials do not match our records.';
            $this->responsee(false, $this->d_err);
        }
        return json_response($this->resp, $this->httpCode);
    }
    
    public function logout(Request $request)
    {
        if ($request->is('api*')) {
            $id = Auth::user()->id;
            $user = User::find($id);
            // var_dump($user); die;
            $user->is_online = '1';
            $user->save();
            $user->update(['is_online' => '0']);
            $request->user()->currentAccessToken()->delete();
            $this->responsee(true);
            return json_response($this->resp, $this->httpCode);
        }
    }
    public function logoutAll(Request $request)
    {
        $this->data = $DB::table('users')->update(['is_online' => '0']);
        DB::table('personal_access_tokens')->truncate();
        $this->responsee(true);
        return json_response($this->resp, $this->httpCode);
    }
    public function verifyLicenseKey(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'license_key' => 'required',
        ]);
        if ($validator->fails())
            $this->responsee(false, implode(',', $validator->errors()->all()));
        else{
            $user = User::find(Auth::user()->id);
            if($user){
                if ($user->license_key === $request->license_key) {
                    if($user->is_license_key_verified==true){
                        $this->d_err = 'License key already verified';
                        $this->responsee(false, $this->d_err);
                    }else{
                        if($user->update(['is_license_key_verified' => true])){
                            $this->data = true;
                            $this->responsee(true);
                        }else{
                            $this->responsee(false, $this->w_err);
                        }
                    }
                }else{
                    $this->d_err = 'Invalid License Key';
                    $this->responsee(false, $this->d_err);
                }
            }else{
                $this->d_err = 'User not found';
                $this->responsee(false, $this->d_err);
            }
        }
        return json_response($this->resp, $this->httpCode);
    }
}
