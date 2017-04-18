<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
	public $timestamps = false;
	protected $table = 'tblDriver';
	protected $primaryKey = 'intDriverID';  

	public function LicenseType(){
		return $this->hasOne('App\Models\LicenseType', 'intLicenseId', 'intLicenseType');
	}

	public function Ticket(){
		return $this->belongsTo('App\Models\Ticket', 'intDriverID', 'intDriverID');
	}

}
