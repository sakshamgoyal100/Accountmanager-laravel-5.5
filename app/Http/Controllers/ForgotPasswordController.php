<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForgotPassModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class ForgotPasswordController extends Controller
{
    public function Forgot(Request $request)
    {
       $email = $request->input('email');	
       session()->put('enteredEmail',$email);

       $otp = rand(1000,9999);
       
       $query = ForgotPassModel::InsertData($email,$otp);

       if ($query) {

       	   Mail::to($email)->send(new OtpMail($otp));
           return view('enter-otp');

       }else{

       	   return "Something went wrong.";
       }
    }

    public function CreatePass(Request $request)
    {
         $otp = $request->input('OTP');

         $query = ForgotPassModel::VerifyOtp($otp);

         if ($query && session()->has('otpid')) {
         	
         	return view('create-new-password');

         }else{
            
            return "fail";

         }
    }

    public function SetPass(Request $request)
    {
         $newpassword = $request->input('password');

         $query = ForgotPassModel::SetPassword($newpassword);
        
         if ($query) {
           
             session()->flush();
             session()->put('showMsg','Your Password Changed Successfully.');
             return view('login');

         }else{
             return "error";
         }







    }

}
