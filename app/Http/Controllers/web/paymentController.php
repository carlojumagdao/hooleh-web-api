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
	    	
            $result = DB::table('tblPayment')
            ->select('strConfirmationNumber')
            ->orderBy('strConfirmationNumber', 'desc')
            ->first();

	        if (empty($result)){
	        	$confirmationNumber = 'CN-00001-AC';
	        } else {
	        	$confirmationNumber = $result->strConfirmationNumber;
	        }
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
    public function portal(Request $request){

        $result = DB::table('tblPayment')
            ->select('strConfirmationNumber')
            ->orderBy('strConfirmationNumber', 'desc')
            ->first();

        if (empty($result)){
        	$confirmationNumber = 'CN-00001-AC';
        } else {
        	$confirmationNumber = $result->strConfirmationNumber;
        }

        $counter = new SmartCounter();
        $newConfirmationNumber = $counter->smartcounter($confirmationNumber);

        $reference1 = $request->strTransactionControlNumber;
        $reference2 = $request->strDriverLicense;
        $amount = $request->dblPaymentAmount;

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api-uat.unionbankph.com/uhac/sb/payments/initiate",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\"channel_id\":\"HoolehApp\",\"transaction_id\":\"$newConfirmationNumber\",\"source_account\":\"101153395716\",\"source_currency\":\"PHP\",\"biller_id\":\"DPOS-QC\",\"reference1\":\"$reference1\",\"reference2\":\"$reference2\",\"reference3\":\"000000000C\",\"amount\":$amount}",
		CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			"content-type: application/json",
			"x-ibm-client-id:ae08bb4f-668a-464a-bcc4-d6d93ab53de0",
			"x-ibm-client-secret:cN1tI7aQ5mB3sL4jA4iA2bG7gD8lV4sT3uH3oL4fE8eU0oU0rM"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  	return view('errors.503');
		} else {
			$manage = (array) json_decode($response);
			if($manage['status'] == 'F'){
				var_dump($manage);
			} else {
				try{
					DB::beginTransaction();  
					$transHeader = TransactionHeader::where('strControlNumber', $request->strTransactionControlNumber)->first();
			    	$transHeader->blPaymentStatus = 1;
			    	$transHeader->save();

			    	$driverID = $transHeader->intDriverID;

			    	$payment = new Payment;
			    	$payment->strTransactionControlNumber 	= $request->strTransactionControlNumber;
			    	$payment->strConfirmationNumber			= $manage['confirmation_no'];
			    	$payment->intAdminID 					= 1;
			    	$payment->blPaymentMethod 				= 1;
			        $payment->dblPaymentAmount 				= $request->dblPaymentAmount;
			        $payment->datPaymentTransaction 		= Carbon\Carbon::now();
			        $payment->save();
			        DB::commit();
			        return view('payment.portalSuccessful', ['strConfirmationNumber' => $manage['confirmation_no'], 'driverID' => $driverID]);
				} catch(Exception $f){
					DB::rollBack();
					echo $f->getMessage();
				}
			}
		}
    }
}
