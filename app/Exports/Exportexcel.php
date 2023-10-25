<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Exportexcel implements FromView
{
    protected $user;
    protected $transactions;
    protected $sum;


    public function __construct($transactions, $user,$sum)
    {
        $this->transactions = $transactions;
        $this->user = $user;
        $this->sum = $sum;

    }

    public function view(): View
    {
        return view('pdf', [
            'user' => $this->user,
            'transactions' => $this->transactions,
            'sum' => $this->sum,
        ]);
    }
}
