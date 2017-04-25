<?php

namespace App\Http\Controllers\portal;

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
class driverPortalController extends Controller
{
    public function profile($id)
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
            	->orderBy('tblViolationTransactionHeader.blPaymentStatus')
            	->get();


        $driverTotalFine = 0;
        foreach ($driverViolations as $value) {
            ($value->blPaymentStatus == 0) ? $driverTotalFine +=  $value->totalFine : $driverTotalFine = 0;
        }
        
        if (!is_null($driver)){
            return view('portal.driver.index', ['driver' => $driver, 'driverViolations' => $driverViolations, 'LicenseType' => $LicenseType, 'driverTotalFine' => $driverTotalFine]);
        }else{
            return view('errors.404');
        }  
    }
}
