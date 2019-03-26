<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class risk_factor_asignation extends Model
{
    //
    protected $table = 'RISK_FACTOR_ASIGNATION';

    protected $primaryKey = 'id_asignation';

    protected $fillable = [ 'id_proccess', 'id_factor'];




    public function risksFactor()
    {
        return $this->belongsTo('App\RisksFactor', 'ID_FACTOR', 'ID_FACTOR');
    }

    public function risksProccess()
    {
        return $this->belongsTo('App\RisksProcess', 'ID_PROCCESS', 'ID_PROCCESS');
    }
}
