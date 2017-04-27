<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\SmartCounter AS SmartCounter;
use App\Models\Driver;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class DriverViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = JWTAuth::parseToken()->toUser();
            $now = date("Y-m-d H:i:s");
            $driverID = DB::table('tblDriver')
                ->select('intDriverID')
                ->where('strDriverLicense', $request->strDriverLicenseNumber)
                ->first();

            $result = DB::table('tblViolationTransactionHeader')
                ->select('strControlNumber')
                ->orderBy('strControlNumber', 'desc')
                ->first();

            if (is_null($result)){
                $violationControlNumber = 'CO-000001-01';
            } else {
                $violationControlNumber = $result->strControlNumber;
            }

            $counter = new SmartCounter();

            $id = DB::table('tblViolationTransactionHeader')->insertGetId([
                'strControlNumber' => $counter->smartcounter($violationControlNumber),
                'intEnforcerID' => $user->Enforcer->intEnforcerID,
                'intDriverID' => $driverID->intDriverID,
                'strRegistrationSticker' => $request->strRegistrationSticker,
                'strPlateNumber' => $request->strPlateNumber,
                'intVehicleTypeID' => $request->intVehicleTypeID,
                'dblLatitude' => $request->dblLatitude,
                'dblLongitude' => $request->dblLongitude,
                'TimestampCreated' => $now
            ]);

            $violations = json_decode($request->violations);
            
            foreach ($violations as $value) {
                DB::table('tblViolationTransactionDetail')->insert([
                    'intViolationTransactionHeaderID' => $id,
                    'intViolationID' => $value->intViolationID
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => "Driver's Offense Filed.",
                'status code' => '201'
            ]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enforcerListViolationToday(){
        $user = JWTAuth::parseToken()->toUser();
        $now = Carbon::now();
        $now->hour = 0;
        $now->minute = 0;
        $now->second = 0;   

        $enforcerID = DB::table('tblEnforcer')
            ->select('intEnforcerID')
            ->where('intUserID', $user['original']['id'])
            ->first();

        $enforcerID = DB::table('tblEnforcer')
            ->select('intEnforcerID')
            ->where('intUserID', $user['original']['id'])
            ->first();

        $listViolationToday = DB::table('tblViolationTransactionHeader')
            ->join('tblDriver', 'tblDriver.intDriverID', '=', 'tblViolationTransactionHeader.intDriverID')
            ->select('tblDriver.*', 'tblViolationTransactionHeader.*')
            ->where('tblViolationTransactionHeader.TimestampCreated', '>=', $now)
            ->where('tblViolationTransactionHeader.intEnforcerID', $enforcerID->intEnforcerID)
            ->get();

        return response()->json($listViolationToday);
    }

    public function enforcerListViolationTodaySelectSearched($license){
        $user = JWTAuth::parseToken()->toUser();
        $now = Carbon::now()->addHours(8);
        $now->hour = 0;
        $now->minute = 0;
        $now->second = 0;

        $enforcerID = DB::table('tblEnforcer')
            ->select('intEnforcerID')
            ->where('intUserID', $user['original']['id'])
            ->first();

        $enforcerID = DB::table('tblEnforcer')
            ->select('intEnforcerID')
            ->where('intUserID', $user['original']['id'])
            ->first();

        $listViolationToday = DB::table('tblViolationTransactionHeader')
            ->join('tblDriver', 'tblDriver.intDriverID', '=', 'tblViolationTransactionHeader.intDriverID')
            ->select('tblDriver.*', 'tblViolationTransactionHeader.*')
            ->where('tblViolationTransactionHeader.TimestampCreated', '>=', $now)
            ->where('tblDriver.strDriverLicense', 'like','%'.$license.'%')
            ->where('tblViolationTransactionHeader.intEnforcerID', $enforcerID->intEnforcerID)
            ->get();

        return response()->json($listViolationToday);
    }

    public function ticketDetails($id){

        $dateViolation = DB::table('tblViolationTransactionHeader')
            ->select('TimestampCreated')
            ->where('strControlNumber', $id)
            ->first();

        $ticketDetails = DB::table('tblViolationTransactionHeader')
            ->join('tblViolationTransactionDetail','tblViolationTransactionDetail.intViolationTransactionHeaderID', '=', 'tblViolationTransactionHeader.intViolationTransactionHeaderID')
            ->join('tblViolation', 'tblViolation.intViolationID', '=', 'tblViolationTransactionDetail.intViolationID')
            ->join('tblViolationFee', 'tblViolationFee.intViolationID', '=', 'tblViolation.intViolationID')
            ->select('tblViolation.*', 'tblViolationFee.dblPrice', 'tblViolationTransactionHeader.blPaymentStatus')
            ->where('tblViolationTransactionHeader.strControlNumber', $id)
            ->where('tblViolationFee.datStartDate', '<=', $dateViolation->TimestampCreated)
            ->where('tblViolationFee.datEndDate', '>=', $dateViolation->TimestampCreated)
            ->get();

        return response()->json($ticketDetails);
    }
}
