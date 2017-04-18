<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
	protected $table = 'tblViolationTransactionHeader';
	protected $primaryKey = 'intViolationTransactionHeaderID';

	public function Enforcer(){
		return $this->hasOne('App\Models\Enforcer', 'intEnforcerID');
	}

	public function Driver(){
		return $this->hasOne('App\Models\Driver', 'intDriverID', 'intDriverID');
	}

	public function VehicleType(){
		return $this->hasOne('App\Models\VehicleType', 'intVehicleTypeID');
	}
}
