<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;


class AddPartyController extends Controller
{
    public function AddParty()
   {

     return view('addparty');

   }



    public function SubmitAddParty(Request $request)
    {
     
      // Insert query
      $party = new Party;
      $party->name = $request['name'];
      $party->mobile = $request['mobile'];          
      $party->address = $request['address'];
      $party->GSTIN = $request['GSTIN'];
      $party->description = $request['description'];
      $party->admin_id = session('id');         
      $party->save();

      return redirect('/invoice');

    }
}
