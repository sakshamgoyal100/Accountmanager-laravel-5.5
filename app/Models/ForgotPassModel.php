<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SuperAdmin;

class ForgotPassModel extends Model
{
    protected $table = "forgot_password";
    protected $primaryKey = "id";
    
    public static function InsertData($email,$otp)
    {
    	$forgot = new ForgotPassModel();
    	$forgot->email = $email;
    	$forgot->otp = $otp;
    	$forgot->expiration_time = now()->addminutes(10);
    	
    	try{
            $forgot->save();
            session()->put('otpid',$forgot->id);
            return true;
    	}catch(\Exception $e){
            return false;
    	}
    }

    public static function VerifyOtp($otp)
    {
    	$data = ForgotPassModel::where('id',session('otpid'))->first();

    	if ($data->otp == $otp && $data->expiration_time >= now() ) {
    	     return true;	
    	}else{
    		return false;
    	}
    }

    public static function SetPassword($newpassword)
    {
        $update = SuperAdmin::where('email',session('enteredEmail'))->first();
        $update->password = $newpassword;

        try{
            $update->save();
             return true;

        }catch(\Exception $e){
            return false;
        }

    }






}
