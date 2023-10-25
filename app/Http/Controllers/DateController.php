<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Carbon\Carbon;



class DateController extends Controller
{
    public function Date(){

       return view('datewisetransaction');
    }

    public function GetTransactionData(Request $request){

       $carbonDate = Carbon::createFromFormat('d F Y', $request->date);
       $startDate = $carbonDate->format('Y-m-d 00:00:00');
       $endDate = $carbonDate->format('Y-m-d 23:59:59');

       $transactions = Transaction::whereBetween('updated_at', [$startDate, $endDate])->get();
       


       return response()->json($transactions);

    }
}
