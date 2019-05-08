<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riskFactorCalificationDetail extends Model
{
    //
    protected $table = 'RISK_FACTOR_CALIFICATION_IN';

    protected $primaryKey = 'ID';

    protected $fillable = [ 'ID_CALIFICATION', 'ID_FACTOR','VALOR'];




    public function risksCalification()
    {
        return $this->belongsTo('App\risksCalification', 'ID_CALIFICATION', 'ID_CALIFICATION');
    }

   
}
