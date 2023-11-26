<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class InvoiceModel extends Model
{
    protected $table = "invoice";
    protected $primaryKey = "id";

    public static function GetReportData($startDate,$endDate)
    {
       	$startFormat = Carbon::createfromFormat('d F Y',$startDate);
        $startNew = $startFormat->format('Y-m-d');

        $endFormat = Carbon::createfromFormat('d F Y',$endDate);
        $endNew = $endFormat->format('Y-m-d');

        return self::join('party','invoice.party_id','=','party.id')
               ->select('invoice.*','party.name','party.GSTIN','party.address')
               ->where('invoice.admin_id',session('id'))
               ->whereBetween('invoice.invoice_date',[$startNew,$endNew])
               ->get();
    }

    public static function GetTotalSum($startDate,$endDate)
    {
       $startFormat = Carbon::createfromFormat('d F Y', $startDate);
       $startNew = $startFormat->format('Y-m-d');
       
       $endFormat = Carbon::createfromFormat('d F Y',$endDate);
       $endNew = $endFormat->format('Y-m-d');

       return self::selectRaw('SUM(total_amount) AS total')
              ->where('admin_id',session('id'))
              ->whereBetween('invoice_date',[$startNew,$endNew])
              ->first();
     }


}
