<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
	public $timestamps = false;
	protected $table = 'tblViolationTransactionHeader';
	public $primaryKey = 'intViolationTransactionHeaderID';
}
