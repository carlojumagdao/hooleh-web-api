<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Violation;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now = Carbon::now()->addHours(8);
        $violations = DB::table('tblViolation')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where([
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now]
            ])
            ->select('tblViolation.*', 'tblViolationFee.dblPrice')
            ->orderBy('tblViolation.strViolationDescription', 'asc')
            ->get();

        return response()->json($violations);
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
        $user = JWTAuth::parseToken()->toUser();
        if ($user['original']['tinyintIdentifier'] == 1){
            try {
                DB::beginTransaction();

                $violationID = DB::table('tblViolation')->insertGetId([
                    'strViolationCode' => $request->strViolationCode,
                    'strViolationDescription' => $request->strViolationDescription
                ]);

                DB::table('tblViolationFee')->insert([
                    'intViolationID' => $violationID,
                    'dblPrice' => $request->dblPrice
                ]);

                DB::commit();
                return response()->json(
                    [
                        'message' => 'Violation Created.',
                        'status code' => 201
                    ]
                );
            } catch (Exception $e) {
                return response()->json(
                    [
                        'message' => $e.getMessage(),
                        'status code' => 400
                    ]
                );
            }
        } else{
            return response()->json([
                'message' => 'Unauthorized.',
                'status Code' => 401
            ]);
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
        $now = Carbon::now()->addHours(8);
        $violation = DB::table('tblViolation')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where([
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now]
            ])
            ->where('tblViolation.intViolationID', $id)
            ->select('tblViolation.*', 'tblViolationFee.dblPrice')
            ->first();

        return response()->json($violation);
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
        $user = JWTAuth::parseToken()->toUser();
        if ($user['original']['tinyintIdentifier'] == 1){
            $violation = Violation::find($id);
            if (!is_null($violation)){
                try {
                    DB::beginTransaction();
                    $now = Carbon::now()->addHours(8);
                    $violationFee = DB::table('tblViolationFee')
                        ->where('tblViolationFee.intViolationID', $id)
                        ->where([
                            ['tblViolationFee.datStartDate', '<=', $now],
                            ['tblViolationFee.datEndDate', '>=', $now]
                        ])
                        ->select('tblViolationFee.*')
                        ->first();
                    
                    $violation->strViolationCode = $request->strViolationCode;
                    $violation->strViolationDescription = $request->strViolationDescription;    
                    $violation->save();

                    $request->dblPrice = (double) $request->dblPrice;
                    if ($request->dblPrice != $violationFee->dblPrice){
                        DB::table('tblViolationFee')->insert([
                            'dblPrice' => $request->dblPrice,
                            'intViolationID' => $id
                        ]);

                        DB::table('tblViolationFee')
                            ->where('intViolationFeeID', $violationFee->intViolationFeeID)
                            ->update([
                                'datEndDate' => $now
                            ]);
                    }
                    DB::commit();
                    return response()->json(
                        [
                            'message' => 'Violation Updated.',
                            'status code' => 200
                        ]
                    );
                } catch (Exception $e) {
                    DB::rollback();
                    return response()->json(
                        [
                            'message' => $e->getMessage(),
                            'status code' => 400
                        ]
                    );
                }
                    
            }else{
                return response()->json(
                    [
                        'message' => 'Violation not Found. Update Failed.',
                        'status code' => 400
                    ]
                );
            }
        } else{
            return response()->json([
                'message' => 'Unauthorized.',
                'status Code' => 401
            ]);
        }
            
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
}
