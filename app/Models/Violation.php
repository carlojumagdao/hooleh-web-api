<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
	public $timestamps = false;
	protected $table = 'tblViolation';
	protected $primaryKey = 'intViolationID';
}
