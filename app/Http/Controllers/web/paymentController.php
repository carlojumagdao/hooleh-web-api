<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\TransactionHeader;
use App\Http\Requests;
use Carbon;
use App\SmartCounter AS SmartCounter;
use DB;
use App\Http\Controllers\Controller;


class paymentController extends Controller
{
    public function walkin(Request $request){

    	try{
            DB::beginTransaction();
	    	
            $confirmationNumber = DB::table('tblPayment')
                ->select('strConfirmationNumber')
                ->orderBy('strConfirmationNumber', 'desc')
                ->first();
            $counter = new SmartCounter();
            $newConfirmationNumber = $counter->smartcounter($confirmationNumber->strConfirmationNumber);


	    	$transHeader = TransactionHeader::where('strControlNumber', $request->strTransactionControlNumber)->first();
	    	$transHeader->blPaymentStatus 				= 1;
	    	$transHeader->save();

	    	$driverID = $transHeader->intDriverID;

	    	$payment = new Payment;
	    	$payment->strTransactionControlNumber 	= $request->strTransactionControlNumber;
	    	$payment->strConfirmationNumber			= $newConfirmationNumber;
	    	$payment->intAdminID 					= 1;
	    	$payment->blPaymentMethod 				= 0;
	        $payment->dblPaymentAmount 				= $request->dblPaymentAmount;
	        $payment->datPaymentTransaction 		= Carbon\Carbon::now();
	        $payment->save();
	        DB::commit();

	        return view('payment.successful', ['strConfirmationNumber' => $newConfirmationNumber, 'driverID' => $driverID]);
        }catch (\Illuminate\Database\QueryException $e){
	        DB::rollBack();	
	        return $e->getMessage();
	        return "error";
        }
    }
}
