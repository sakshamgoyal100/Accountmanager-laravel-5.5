<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Transaction;



class SelectUserController extends Controller
{
	public function select(){

      if(@session('id')){

        $users = Users::where('admin_id',session('id'))->get();
        $transactions = Transaction::where('admin_id',session('id'))->selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')->first();

      }else{
         
         $users = Users::all();
         $transactions = Transaction::selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')->first();

      }

      

      $data = compact('users','transactions'); 
      return view('selectuser')->with($data);
		
	}
    
}
