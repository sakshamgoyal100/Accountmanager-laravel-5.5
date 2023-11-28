<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\InvoiceModel;
use Carbon\Carbon;



class AddInvoiceController extends Controller
{
    public function ViewInvoice()
    {
        $parties = Party::where('admin_id',session('id'))->get();

        $invoices = InvoiceModel::join('party', 'invoice.party_id', '=', 'party.id')
				    ->select('invoice.*', 'party.name', 'party.GSTIN')
				    ->where('invoice.admin_id', session('id'))
				    ->get();

        

    	return view('addinvoice',compact('parties','invoices'));
    }

        public function SubmitForm(Request $request)
    {      
       try {

	        
            if ($request->input('id') && $request->input('id') !== '') {

		        $invoice = InvoiceModel::find($request->input('id'));

		    } else {

		        $invoice = new InvoiceModel();
                
		    }
	                  
	        $invoice->party_id = $request->input('party_id');
	        $invoice->taxable_amount = $request->input('taxable_amount');
	        $invoice->tax_slab = $request->input('tax_slab');
	        $invoice->total_amount = $request->input('total_amount');
	        $invoice->invoice_number = $request->input('invoice_number');
            $invoice->admin_id = session('id');


	        $inputDate = $request->input('date');
            $carbonDate = Carbon::createFromFormat('d F Y', $inputDate);
            $formattedDate = $carbonDate->format('Y-m-d');

	        $invoice->invoice_date = $formattedDate; 
             


	        $invoice->save();
            
	        // Return a JSON response on success
	        return response()->json(['status' => 'success', 'message' => 'Invoice saved successfully']);
        
            }catch (\Exception $e) {
		        // Log the error for debugging
		        \Log::error('Error saving Invoice: ' . $e->getMessage() . ' Stack trace: ' . $e->getTraceAsString());


		        // Return a JSON response on failure
		        return response()->json(['status' => 'error', 'message' => 'Failed to save Invoice'], 500);
		    }
    }

    public function DeleteInvoice($invoice_id){
            
            $invoice = Invoice::find($invoice_id)->delete();

            return response()->json($invoice);


     }
 

}    
  




