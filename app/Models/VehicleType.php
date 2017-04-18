<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    public $timestamps = false;
	protected $table = 'tblVehicleType';
	protected $primaryKey = 'intVehicleID';

	public function Ticket(){
		return $this->belongsTo('App\Models\Ticket', 'intVehicleTypeID', 'intVehicleTypeID');
	}
}
