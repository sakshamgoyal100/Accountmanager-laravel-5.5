<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Exports\Exportexcel;


class ViewController extends Controller
{
	public function view($id)
	{
    	$user = Users::where('id', '=', $id)->where('admin_id',session('id'))
        ->first();
        
        if ($user == null) {
             
             return view('index');
             
         } else{
        // Using compact to pass data to the view
        return view('view', compact('user'));
         }
    }

    public function GetTransactionData($user_id)
    {
 
    $transactions = Transaction::where('user_id', $user_id)
                    ->where('admin_id',session('id'))
                    ->get();

    return response()->json($transactions);
    }

    public function SubmitForm(Request $request)
    {      
       try {

	        
            if ($request->input('id') && $request->input('id') !== '') {

		        $transactions = Transaction::find($request->input('id'));
		    } else {

		        $transactions = new Transaction();
		    }

	        if($request->input('amountType') == 'credit'){
            	$transactions->credit = $request->input('amount');
	        	$transactions->debit = 0;
            }
            else{
            	$transactions->credit = 0;
	        	$transactions->debit = $request->input('amount');
            }
	                  
	        $transactions->user_id = $request->input('user_id');
	        $transactions->note = $request->input('note');

	        $inputDate = $request->input('date');
            $carbonDate = Carbon::createFromFormat('d F Y h:i a', $inputDate);
            $formattedDate = $carbonDate->format('Y-m-d H:i:s');

	        $transactions->updated_at = $formattedDate; 
	        $transactions->created_at = $formattedDate;

            $transactions->admin_id = session('id');


	        $transactions->save();

	        // Return a JSON response on success
	        return response()->json(['status' => 'success', 'message' => 'Transaction saved successfully']);
        
            }catch (\Exception $e) {
		        // Log the error for debugging
		        \Log::error('Error saving transaction: ' . $e->getMessage() . ' Stack trace: ' . $e->getTraceAsString());


		        // Return a JSON response on failure
		        return response()->json(['status' => 'error', 'message' => 'Failed to save transaction'], 500);
		    }
     }

    public function DeleteTransactionData($trans_id)
    {        
            $transactions = Transaction::find($trans_id)->delete();
            return response()->json($transactions);
    }

    public function generatePDF($user_id)
    {
        
        $user = Users::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)->get();

        $sum = Transaction::where('user_id', $user_id)
               ->selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')
               ->first();


        $pdfContent = view('user_report_pdf_excel', compact('user','transactions','sum'));

        $pdf = \PDF::loadHTML($pdfContent);

        return $pdf->download($user->name.'-'.today()->toDateString().'.pdf');
    }

    public function excel($user_id)
    {
        $user = Users::find($user_id);

        $transactions = Transaction::where('user_id', $user_id)
                        ->get();

        $sum = Transaction::selectRaw('SUM(credit) as total_credit, SUM(debit) as total_debit')
               ->where('user_id', $user_id)
               ->first();
        

        return \Excel::download(new Exportexcel($transactions,$user,$sum), $user->name.'-'.today()->toDateString().'.xlsx');

    }

}     

