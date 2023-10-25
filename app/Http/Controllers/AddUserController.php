<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class AddUserController extends Controller
{

   public function AddUser()
   {

     return view('adduser');

   }



    public function SubmitAddUser(Request $request)
    {
     
      // Insert query
      $users = new Users;
      $users->name = $request['name'];
      $users->mobile = $request['mobile'];          
      $users->address = $request['address'];
      $users->admin_id = session('id');         
      $users->save();

      return redirect('/index');

    }
}
