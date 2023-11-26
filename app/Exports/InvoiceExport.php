<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class InvoiceExport implements FromView
{
    protected $invoices;
    protected $totalsum;
    protected $startDate;
    protected $endDate;


    public function __construct($invoices,$totalsum, $startDate,$endDate)
    {
        $this->totalsum = $totalsum;
        $this->invoices = $invoices;
        $this->startDate = $startDate;
        $this->endDate = $endDate;

    }

    public function view(): View
    {
        return view('invoice_pdf_excel', [
            'invoices' => $this->invoices,
            'totalsum' => $this->totalsum,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ]);
    }
}
