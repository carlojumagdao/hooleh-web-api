<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Hash;
use App\Models\TransactionHeader;
use App\Models\Enforcer;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SmartCounter;

class enforcerController extends Controller
{
    public function index(){
    	$enforcers = Enforcer::where('blEnforcerDelete', 0)
            ->orderBy('strEnforcerFirstname', 'asc')
            ->get();
        return view('enforcer.index', ['enforcers' => $enforcers]);
    }

    public function show($id)
    {
        $enforcer = Enforcer::find($id);
        $transactionHeader = TransactionHeader::where('intEnforcerID', $id)
                ->count('intViolationTransactionHeaderID');
        if (!is_null($enforcer)){
            return view('enforcer.show', ['enforcer' => $enforcer, 'transactionHeader' => $transactionHeader]);
        }else{
            return view('errors.404');
        }  
    }

    public function getEnforcerData(){
    	$enforcers = Enforcer::where('blEnforcerDelete', 0)
            ->orderBy('strEnforcerFirstname', 'asc')
            ->get();
        return $enforcers;
    }

    public function filter(Request $request){
    	$enforcers = Enforcer::where('blEnforcerDelete', $request->selFilterValue)
            ->orderBy('strEnforcerFirstname', 'asc')
            ->get();
        if($request->selFilterValue){
        	return view('enforcer.Table.enforcerSuspendTable', ['enforcers' => $enforcers]);
        } else {
        	return view('enforcer.Table.enforcerTable', ['enforcers' => $enforcers]);
        }
    }

    public function suspend(Request $request){
    	$enforcer = Enforcer::find($request->strPrimaryKey);
        if (!is_null($enforcer)){
            $enforcer->blEnforcerDelete = 1;
            $enforcer->TimestampDeleted = Carbon\Carbon::now();
            $enforcer->save();
            $enforcersNewDataSet = $this->getEnforcerData();
            return view('enforcer.Table.enforcerTable', ['enforcers' => $enforcersNewDataSet]);
        }else{
            return "error";	
        }
    }


    public function restore(Request $request){
    	$enforcer = Enforcer::find($request->strPrimaryKey);
        if (!is_null($enforcer)){
            $enforcer->blEnforcerDelete = 0;
            $enforcer->TimestampUpdated = Carbon\Carbon::now();
            $enforcer->save();
            $enforcersNewDataSet = $this->getEnforcerData();
            return view('enforcer.Table.enforcerTable', ['enforcers' => $enforcersNewDataSet]);
        }else{
            return "error";	
        }
    }

    public function create(Request $request){
    	try{
            DB::beginTransaction();  

            $enforcer = new Enforcer;
            $user = new User;

        	$user->username 			= $request->strEnforcerID;
        	$user->remember_token 		= str_random(60);
            $user->password 			= Hash::make($request->strPassword);
            $user->tinyintIdentifier 	= 0;

            $user->save();
            
            $enforcer->strEnforcerEmail 	= $request->strEnforcerID;
            $enforcer->strEnforcerFirstname = $request->strFirstname;
            $enforcer->strEnforcerLastname 	= $request->strLastname;
            $enforcer->intUserID 			= $user->id;
            $enforcer->save();

            $enforcersNewDataSet = $this->getEnforcerData();
            DB::commit();
            return view('enforcer.Table.enforcerTable', ['enforcers' => $enforcersNewDataSet]);
        }catch (\Illuminate\Database\QueryException $e){
	        DB::rollBack();	
	        //return $e->getMessage(); for debugging
	        return "error";
        }
    }

    public function update(Request $request)
    {
        $enforcer = Enforcer::find($request->strPrimaryKey);

        if (!is_null($enforcer)){
            $enforcer->strEnforcerFirstname = $request->strFirstname;
            $enforcer->strEnforcerLastname = $request->strLastname;
            $enforcer->TimestampUpdated = Carbon\Carbon::now();
            $enforcer->save();
            $enforcersNewDataSet = $this->getEnforcerData();
            return view('enforcer.Table.enforcerTable', ['enforcers' => $enforcersNewDataSet]);
        }else{
            return "error";	
        }
    }

	public function resetpassword(Request $request)
    {
        $user = User::find($request->intUserID);
        if (!is_null($user)){
            $user->password = Hash::make($request->strPassword);
            $user->save();
            return "success";
        }else{
            return "error";	
        }
    }
}
