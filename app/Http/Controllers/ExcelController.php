<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Exportexcel;

class ExcelController extends Controller
{
    public function export($user_id)
    {
        $user = Users::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)->get();

        $sum = Transaction::selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')->where('user_id', $user_id)->first();
        

        return Excel::download(new Exportexcel($transactions,$user,$sum), $user->name.'-'.today()->toDateString().'.xlsx');

    }
}
