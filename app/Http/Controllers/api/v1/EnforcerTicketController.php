<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Ticket;

use Carbon\Carbon;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class EnforcerTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $enforcerTickets = DB::table('tblViolationTransactionHeader')
            ->join('tblDriver', 'tblDriver.intDriverID', '=', 'tblViolationTransactionHeader.intDriverID')
            ->join('tblVehicleType', 'tblVehicleType.intVehicleTypeID', '=', 'tblViolationTransactionHeader.intVehicleTypeID')
            ->select('tblDriver.*', 'tblVehicleType.strVehicleDescription', 'tblViolationTransactionHeader.*')
            ->where('intEnforcerID', $id)
            ->get();

        return response()->json($enforcerTickets);
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
            $driverID = DB::table('tblDriver')
                ->select('intDriverID')
                ->where('strDriverLicense', $request->strDriverLicenseNumber)
                ->first();

            $id = DB::table('tblViolationTransactionHeader')->insertGetId([
                'strControlNumber' => $request->strControlNumber,
                'intEnforcerID' => $user->Enforcer->intEnforcerID,
                'intDriverID' => $driverID->intDriverID,
                'strRegistrationSticker' => $request->strRegistrationSticker,
                'strPlateNumber' => $request->strPlateNumber,
                'intVehicleTypeID' => $request->intVehicleTypeID,
                'dblLatitude' => $request->dblLatitude,
                'dblLongitude' => $request->dblLongitude
            ]);

            $violations = $request->violations;
            foreach ($violations as $value) {
                DB::table('tblViolationTransactionDetail')->insert([
                    'intViolationTransactionHeaderID' => $id,
                    'intViolationID' => $value
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

    public function enforcerTicket(Request $request){
        
    }
}
