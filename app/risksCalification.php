<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class risksCalification extends Model
{
    //
    protected $table = 'RISKS_FACTOR_CALIFICATION';

    protected $primaryKey = 'ID_CALIFICATION';

    protected $fillable = [ 'ID_USER', 'PROMEDIO','DATE_CALIFICATION'];




    public function risksFactor()
    {
        return $this->belongsTo('App\RisksFactor', 'ID_FACTOR', 'ID_FACTOR');
    }

    public function risksProccess()
    {
        return $this->belongsTo('App\RisksProcess', 'ID_PROCCESS', 'ID_PROCCESS');
    }
}
