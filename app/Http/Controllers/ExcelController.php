<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Transaction;
use App\Exports\Exportexcel;

class ExcelController extends Controller
{
    public function excel($user_id)
    {
        $user = Users::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)->get();

        $sum = Transaction::selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')->where('user_id', $user_id)->first();
        

        return \Excel::download(new Exportexcel($transactions,$user,$sum), $user->name.'-'.today()->toDateString().'.xlsx');

    }
}
