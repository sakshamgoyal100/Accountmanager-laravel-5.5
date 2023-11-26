<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceReportController extends Controller
{
    public function viewReport()
    {
       return view('/invoicereport');
    }

    public function GetReportData(Request $request)
    {
       $startDate = $request->input('startDate');
       $startFormat = Carbon::createfromFormat('d F Y',$startDate);
       $startNew = $startFormat->format('Y-m-d');
       
       $endDate = $request->input('endDate');
       $endFormat = Carbon::createfromFormat('d F Y',$endDate);
       $endNew = $endFormat->format('Y-m-d');

       $invoice = Invoice::join('party','invoice.party_id','=','party.id')
                  ->select('invoice.*','party.name','party.GSTIN')
                  ->where('invoice.admin_id',session('id'))
                  ->whereBetween('invoice.invoice_date',[$startNew,$endNew])
                  ->get();

       return response()->json($invoice);
    }
}
