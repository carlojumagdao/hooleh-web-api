<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = JWTAuth::parseToken()->toUser();
        if ($users['original']['tinyintIdentifier'] == 1){
            $drivers = DB::table('tblDriver')
                ->join('tblLicenseType', 'tblDriver.intLicenseType', '=', 'tblLicenseType.intLicenseId')
                ->select('tblDriver.*', 'tblLicenseType.strLicenseType')
                ->orderBy('tblDriver.strDriverLastName', 'asc')
                ->get();

            return response()->json($drivers);
        } else{
            return response()->json([
                'message' => 'Unauthorized.',
                'status Code' => 401
            ]);
        }
            
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
        $users = JWTAuth::parseToken()->toUser();
        if ($users['original']['tinyintIdentifier'] == 1){
            try {

                $existingDriver = DB::table('tblDriver')
                    ->select('intDriverID')
                    ->where('strDriverLicense', $request->strDriverLicense)
                    ->first();

                if (is_null($existingDriver)){
                    $driver = new Driver;

                    $driver->strDriverLicense = $request->strDriverLicense;
                    $driver->strDriverFirstName = $request->strDriverFirstName;
                    $driver->strDriverMiddleName = $request->strDriverMiddleName;
                    $driver->strDriverLastName = $request->strDriverLastName;
                    $driver->intLicenseType = $request->intLicenseType;
                    $driver->datLicenseExpiration = $request->datLicenseExpiration;
                    $driver->datDriverBirthday = $request->datDriverBirthday;

                    $driver->save();

                    return response()->json([
                        'message' => 'Driver Added',
                        'status code' => 201
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Driver Exists.'
                    ]);
                }

                    
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e.getMessage(),
                    'status code' => 404
                ]);
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
        $driver = DB::table('tblDriver')
            ->join('tblLicenseType', 'tblDriver.intLicenseType', '=', 'tblLicenseType.intLicenseId')
            ->select('tblDriver.*', 'tblLicenseType.strLicenseType')
            ->where('tblDriver.strDriverLicense', $id)
            ->first();

        if (!is_null($driver)){
            return response()->json($driver);
        }else{
            return response()->json([
                'message' => 'Driver not Found.',
                'status code' => 404
            ]);
        }
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
}
