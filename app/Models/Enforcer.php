<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enforcer extends Model
{
	public $timestamps = false;
	protected $table = 'tblEnforcer';
	protected $primaryKey = 'intEnforcerID';

	public function User(){
		return $this->belongsTo('\App\User');
	}

	public function Ticket(){
		return $this->belongsTo('\App\Models\Ticket', 'intEnforcerID', 'intEnforcerID');
	}
}
