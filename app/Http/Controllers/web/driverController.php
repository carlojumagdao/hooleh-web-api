<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Hash;
use App\Models\Driver;
use App\Models\Payment;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use App\Models\LicenseType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class driverController extends Controller
{
    public function index(){
    	$drivers = Driver::where('blDriverDelete', 0)
            ->orderBy('strDriverFirstname', 'asc')
            ->get();
        return view('driver.index', ['drivers' => $drivers]);
    }

    public function show($id)
    {
        $driver = Driver::find($id);
        $LicenseType = $driver->LicenseType;
        $driverViolations = DB::table('tblViolationTransactionHeader')
        		->select(DB::raw('SUM(tblViolationFee.dblPrice) as totalFine'),'tblViolationTransactionHeader.*','tblViolationFee.*')
        		->join('tblViolationTransactionDetail', 'tblViolationTransactionHeader.intViolationTransactionHeaderID', '=', 'tblViolationTransactionDetail.intViolationTransactionHeaderID')
        		->join('tblViolation', 'tblViolationTransactionDetail.intViolationID', '=', 'tblViolation.intViolationID')
        		->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
        		->where('tblViolationTransactionHeader.intDriverID', $id)
        		->whereRaw('tblViolationFee.datEndDate >= tblViolationTransactionHeader.TimestampCreated'
	            )
	            ->whereRaw('tblViolationFee.datStartDate <= tblViolationTransactionHeader.TimestampCreated' 
	            )
	            ->groupBy('tblViolationTransactionHeader.intViolationTransactionHeaderID')
            	->orderBy('tblViolationTransactionHeader.TimestampCreated', 'desc')
            	->get();


        $driverTotalFine = 0;
        foreach ($driverViolations as $value) {
            ($value->blPaymentStatus == 0) ? $driverTotalFine +=  $value->totalFine : $driverTotalFine;
        }
        
        if (!is_null($driver)){
            return view('driver.show', ['driver' => $driver, 'driverViolations' => $driverViolations, 'LicenseType' => $LicenseType, 'driverTotalFine' => $driverTotalFine]);
        }else{
            return view('errors.404');
        }  
    }

    public function ticketShow($driverID, $ticketID){
        $datToday = date("Y/m/d");
        $driver = Driver::find($driverID);
        $driverViolationsBreakdown = DB::table('tblViolationTransactionHeader')
            ->select('tblViolationTransactionDetail.*','tblViolationTransactionHeader.*','tblViolationFee.*','tblViolation.*')
            ->join('tblViolationTransactionDetail', 'tblViolationTransactionHeader.intViolationTransactionHeaderID', '=', 'tblViolationTransactionDetail.intViolationTransactionHeaderID')
            ->join('tblViolation', 'tblViolationTransactionDetail.intViolationID', '=', 'tblViolation.intViolationID')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where('tblViolationTransactionHeader.strControlNumber', $ticketID)
            ->whereRaw('tblViolationFee.datEndDate >= tblViolationTransactionHeader.TimestampCreated')
            ->whereRaw('tblViolationFee.datStartDate <= tblViolationTransactionHeader.TimestampCreated' )
            ->orderBy('tblViolationTransactionHeader.TimestampCreated', 'desc')
            ->get();


        return view('driver.ticket', ['driverViolationsBreakdown' => $driverViolationsBreakdown, 'driver' => $driver, 'ticketNumber' => $ticketID, 'datToday' => $datToday]);
    }

    public function ticketShowInfo($driverID, $ticketID){

        $driver = Driver::find($driverID);
        $transHeader = TransactionHeader::where('strControlNumber', $ticketID)
                        ->join('tblEnforcer', 'tblViolationTransactionHeader.intEnforcerID', '=', 'tblEnforcer.intEnforcerID')
                        ->join('tblVehicleType', 'tblViolationTransactionHeader.intVehicleTypeID', '=', 'tblVehicleType.intVehicleID')
                        ->first();

        if($transHeader->blPaymentStatus){
            $payment = Payment::where('strTransactionControlNumber', $ticketID)
                                    ->first();
        } else{
            $payment = array('strConfirmationNumber' =>  0);
        }

        $driverViolationsBreakdown = DB::table('tblViolationTransactionHeader')
            ->select('tblViolationTransactionDetail.*','tblViolationTransactionHeader.*','tblViolationFee.*','tblViolation.*')
            ->join('tblViolationTransactionDetail', 'tblViolationTransactionHeader.intViolationTransactionHeaderID', '=', 'tblViolationTransactionDetail.intViolationTransactionHeaderID')
            ->join('tblViolation', 'tblViolationTransactionDetail.intViolationID', '=', 'tblViolation.intViolationID')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where('tblViolationTransactionHeader.strControlNumber', $ticketID)
            ->whereRaw('tblViolationFee.datEndDate >= tblViolationTransactionHeader.TimestampCreated')
            ->whereRaw('tblViolationFee.datStartDate <= tblViolationTransactionHeader.TimestampCreated' )
            ->orderBy('tblViolationTransactionHeader.TimestampCreated', 'desc')
            ->get();


        return view('driver.ticketShowInfo', ['driverViolationsBreakdown' => $driverViolationsBreakdown, 'driver' => $driver, 'ticketNumber' => $ticketID, 'transHeader' => $transHeader, 'payment' => $payment]);
    }

}
