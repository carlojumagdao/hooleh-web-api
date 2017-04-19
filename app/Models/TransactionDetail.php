<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
	public $timestamps = false;
	protected $table = 'tblViolationTransactionDetail';
	public $primaryKey = 'intViolationTransactionDetailID';
}
