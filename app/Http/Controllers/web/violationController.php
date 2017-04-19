<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Violation;
use App\Models\ViolationFee;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class violationController extends Controller
{
    public function index()
    {

        $now = Carbon::now()->addHours(8);
        $violations = DB::table('tblViolation')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where([
                ['tblViolation.blViolationDelete', 0],
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now],
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now]
            ])
            ->select('tblViolation.*', 'tblViolationFee.dblPrice')
            ->orderBy('tblViolation.strViolationDescription', 'asc')
            ->get();

        return view('violation.index', ['violations' => $violations]);
    }

    public function show($id)
    {
        $violation = Violation::find($id);
        $violationFee = ViolationFee::findViolationfee($id);
        
        if (!is_null($violation)){
            return view('violation.show', ['violation' => $violation, 'violationFee' => $violationFee]);
        }else{
            return view('errors.404');
        }  
    }

    public function getViolationData(){

        $now = Carbon::now()->addHours(8);
        
        $violations = DB::table('tblViolation')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where([
                ['tblViolation.blViolationDelete', 0],
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now]
            ])
            ->select('tblViolation.*', 'tblViolationFee.dblPrice')
            ->orderBy('strViolationCode', 'asc')
            ->get();
        return $violations;

    }


    public function filter(Request $request){
    	$now = Carbon::now()->addHours(8);
        $violations = DB::table('tblViolation')
            ->join('tblViolationFee', 'tblViolation.intViolationID', '=', 'tblViolationFee.intViolationID')
            ->where([
                ['tblViolation.blViolationDelete', $request->selFilterValue],
                ['tblViolationFee.datStartDate', '<=', $now],
                ['tblViolationFee.datEndDate', '>=', $now]
                
            ])
            ->select('tblViolation.*', 'tblViolationFee.dblPrice')
            ->orderBy('tblViolation.strViolationDescription', 'asc')
            ->get();
        if($request->selFilterValue){
        	return view('violation.Table.violationDeleteTable', ['violations' => $violations]);
        } else {
        	return view('violation.Table.violationTable', ['violations' => $violations]);
        }
    }

    public function create(Request $request){
    	try{
            DB::beginTransaction();  
            
            $violation = new Violation;
            $violationFee = new ViolationFee;

            $violation->strViolationCode        = $request->strCode;
            $violation->strViolationDescription = $request->strDescription;
            $violation->save();

            $violationFee->intViolationID = $violation->intViolationID;
            $violationFee->dblPrice       = $request->dblFine;
            $violationFee->datStartDate   = Carbon::now();

            $violationFee->save();
            
            $violationsNewDataSet = $this->getViolationData();
            DB::commit();
            return view('violation.Table.violationTable', ['violations' => $violationsNewDataSet]);
        }catch (\Illuminate\Database\QueryException $e){
	        DB::rollBack();	
	        //return $e->getMessage(); for debugging
	        return "error";
        }
    }


    public function update(Request $request)
    {
        $violation = Violation::find($request->strPrimaryKey);

        if (!is_null($violation)){
            $violation->strViolationCode = $request->strCode;
            $violation->strViolationDescription = $request->strDescription;
            $violation->TimestampUpdated = Carbon::now();

            $violation->save();

            $violationFee = ViolationFee::findViolationFee($violation->intViolationID);


            if($violationFee->dblPrice != $request->dblFine){
                $violationFeeNew = new ViolationFee;

                $violationFeeNew->intViolationID = $violation->intViolationID;
                $violationFeeNew->dblPrice       = $request->dblFine;
                $violationFeeNew->datStartDate   = Carbon::now();

                $violationFeeNew->save();

                $violationFee->datEndDate        = $violationFeeNew->datStartDate;
                $violationFee->save();

            }
            
            $violationsNewDataSet = $this->getViolationData();
            return view('violation.Table.violationTable', ['violations' => $violationsNewDataSet]);
        }else{
            return "error";	
        }
    }


    public function delete(Request $request){
    	$violation = Violation::find($request->strPrimaryKey);
        if (!is_null($violation)){
            $violation->blViolationDelete = 1;
            $violation->TimestampDeleted = Carbon::now();
            $violation->save();
            $violationsNewDataSet = $this->getViolationData();
            return view('violation.Table.violationTable', ['violations' => $violationsNewDataSet]);
        }else{
            return "error";	
        }
    }

    public function restore(Request $request){
    	$violation = Violation::find($request->strPrimaryKey);
        if (!is_null($violation)){
            $violation->blViolationDelete = 0;
            $violation->TimestampUpdated = Carbon::now();
            $violation->save();
            $violationsNewDataSet = $this->getViolationData();
            return view('violation.Table.violationTable', ['violations' => $violationsNewDataSet]);
        }else{
            return "error";	
        }
    }
}
