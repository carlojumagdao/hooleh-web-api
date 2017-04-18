<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    public $timestamps = false;
    protected $table = 'tblLicenseType';
    protected $primaryKey = 'intLicenseType';

    public function Driver(){
    	return $this->belongsTo('App\Models\Driver', 'intLicenseType', 'intLicenseId');
    }
}
