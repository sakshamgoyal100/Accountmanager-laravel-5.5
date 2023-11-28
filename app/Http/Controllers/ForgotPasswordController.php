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
             
             try{

                 Mail::to($email)->send(new OtpMail($otp));
                 return view('enter-otp');

             }catch (\Exception $e) {
                 session()->put('showMsg','Error sending OTP,Please try later');
                 return redirect('/login');
             }

        }else{

       	     session()->put('showMsg','Something went wrong while generating OTP');
             return view('/login');
        }
    }

    public function VerifyOtp(Request $request)
    {
         $otp = $request->input('OTP');

         $query = ForgotPassModel::VerifyOtp($otp);

         if ($query && session()->has('otpid')) {
         	
         	  return view('create-new-password');

         }else{
            
            session()->put('showMsg','Wrong OTP.');
            return view('/login');

         }
    }

    public function CreateNewPassword(Request $request)
    {
         $newpassword = $request->input('password');

         $query = ForgotPassModel::SetPassword($newpassword);

         if ($query) {
           
             session()->put('showMsg','Your Password Changed Successfully.');
             return view('login');

         }else{
             session()->put('showMsg','Error while creating new password.');
             return view('login');

         }
    }


}
