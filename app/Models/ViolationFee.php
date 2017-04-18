<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class ViolationFee extends Model
{
	public $timestamps = false;
	protected $table = 'tblViolationFee';
	protected $primaryKey = 'intViolationFeeID';

	public static function findViolationfee($violationID)
    {
		$now = Carbon::now()->addHours(8);

        return static::where([
					['intViolationID', $violationID],
					['datStartDate', '<=', $now],
                	['datEndDate', '>=', $now],
		])->first();
		
    }
}
