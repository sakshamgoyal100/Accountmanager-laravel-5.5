<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function login()
   {

      session()->forget('showMsg');
     	return view('login');

   }
   
   public function SubmitLogin(Request $req)
   {

     	$superAdmin = SuperAdmin::where('email', $req->email)->first();

      if ($superAdmin && ($superAdmin->password == $req->password)) {
      	
      	  session([
            'email' => $superAdmin->email,
            'name'=> $superAdmin->name,
            'id'=> $superAdmin->id,
            'address'=> $superAdmin->address,
            'mobile'=> $superAdmin->mobile,
            'GSTIN'=> $superAdmin->GSTIN
          ]);

          return redirect('/index');
      	

      }else{
         
          session()->put('showMsg','Incorrect data.');
          return view('login');
          
      }
   }

}