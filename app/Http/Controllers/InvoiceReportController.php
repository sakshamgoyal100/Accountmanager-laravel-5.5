<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Exports\InvoiceExport;

class InvoiceReportController extends Controller
{
    public function viewReport()
    {
       return view('/invoicereport');
    }

    public function GetReportData(Request $request)
    {
       $startDate = $request->input('startDate');
     
       $endDate = $request->input('endDate');

       $invoice = InvoiceModel::GetReportData($startDate,$endDate);

       return response()->json($invoice);
    }
    
    public function generatePDF($startDate,$endDate)
    {

       $invoices = InvoiceModel::GetReportData($startDate,$endDate);

       $totalsum = InvoiceModel::GetTotalSum($startDate,$endDate); 

       $data = compact('invoices','totalsum','startDate','endDate');

       $pdfcontent =view('invoice_pdf_excel',$data);

       $pdf = \PDF::loadHTML($pdfcontent);

       return $pdf->download(session('name').'-'.now().'.pdf');
    }

    public function generateExcel($startDate,$endDate)
    {

       $invoices = InvoiceModel::GetReportData($startDate,$endDate);

       $totalsum = InvoiceModel::GetTotalSum($startDate,$endDate);

       $export = new InvoiceExport($invoices,$totalsum,$startDate,$endDate);

       return \Excel::download($export,session('name').'-'.now().'.xlsx');



    }



}
