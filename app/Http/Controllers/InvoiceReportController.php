<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function viewReport()
    {
       return view('/invoicereport');
    }
}
