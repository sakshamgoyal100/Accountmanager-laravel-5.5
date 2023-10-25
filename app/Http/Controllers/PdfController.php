<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PdfController extends Controller
{
    public function generatePDF($user_id)
    {
    	
        $user = Users::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)->get();

        $sum = Transaction::selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')->first();


        $pdfContent =  view('pdf', compact('user','transactions','sum'));

         //$pdfContent =

        $pdf = \PDF::loadHTML($pdfContent);

        return $pdf->download($user->name.'-'.today()->toDateString().'.pdf');
    }
}
