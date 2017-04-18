<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use Hash;
use App\Models\Enforcer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use App\User;

class EnforcerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = JWTAuth::parseToken()->toUser();
        if ($user['original']['tinyintIdentifier'] == 1){
            $enforcers = Enforcer::where('blEnforcerDelete', 0)
                ->orderBy('strEnforcerLastname', 'asc')
                ->get();

            return response()->json($enforcers);
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

        $user = JWTAuth::parseToken()->toUser();
        if ($user['original']['tinyintIdentifier'] == 1){
            $enforcer = new Enforcer;
            try {
                DB::beginTransaction();
                $userID = DB::table('users')->insertGetId([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'tinyintIdentifier' => 0
                ]);

                $enforcer->strEnforcerIdNumber = $request->strEnforcerIdNumber;
                $enforcer->strEnforcerFirstname = $request->strEnforcerFirstname;
                $enforcer->strEnforcerMiddlename = $request->strEnforcerMiddlename;
                $enforcer->strEnforcerLastname = $request->strEnforcerLastname;
                $enforcer->strEnforcerPicture = $request->strEnforcerPicture;
                $enforcer->strEnforcerPosition = $request->strEnforcerPosition;
                $enforcer->intUserID = $userID;
                $enforcer->save();
                DB::commit();
                return response()->json([
                        'message' => 'Enforcer Created.',
                        'status code' => 201, 
                        'data' => $enforcer
                    ]
                );
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                return response()->json([
                        'message' => $e->getMessage(),
                        'status code' => 400,
                        'data' => $enforcer
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
        $enforcer = Enforcer::find($id);
        if (!is_null($enforcer)){
            return response()->json($enforcer);
        }else{
            return response()->json([
                    'message' => 'Enforcer not Found.',
                    'status code' => 404
                ]
            );
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
        $enforcer = Enforcer::find($id);

        if (!is_null($enforcer)){
            $enforcer->strEnforcerIdNumber = $request->strEnforcerIdNumber;
            $enforcer->strEnforcerFirstname = $request->strEnforcerFirstname;
            $enforcer->strEnforcerMiddlename = $request->strEnforcerMiddlename;
            $enforcer->strEnforcerLastname = $request->strEnforcerLastname;
            $enforcer->strEnforcerPicture = $request->strEnforcerPicture;
            $enforcer->strEnforcerPosition = $request->strEnforcerPosition;
            $enforcer->strEnforcerUsername = $request->strEnforcerUsername;
            $enforcer->strEnforcerPassword = Hash::make($request->strEnforcerPassword);

            $enforcer->save();

            return response()->json([
                    'message' => 'Enforcer Updated.',
                    'status code' => 201, 
                    'data' => $enforcer
                ]
            );
        }else{
            return response()->json([
                    'message' => 'Enforcer not Found. Update Failed.',
                    'status code' => 400
                ]
            );
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

    public function enforcerCurrentLogin(){
        $user = JWTAuth::parseToken()->toUser();
        return response()->json($user->Enforcer);
    }
}
