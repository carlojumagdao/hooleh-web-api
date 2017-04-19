<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Hash;
use App\Models\Driver;
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
        if (!is_null($driver)){
            return view('driver.show', ['driver' => $driver, 'driverViolations' => $driverViolations, 'LicenseType' => $LicenseType]);
        }else{
            return view('errors.404');
        }  
    }


}
