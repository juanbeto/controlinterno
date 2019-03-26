<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RisksProbabilityCalificationDetail extends Model
{
     //
     protected $table = 'RISK_PROBABILITY_CALIFICATION_DETAIL';

     protected $primaryKey = 'ID_DETAIL';
 
     protected $fillable = [ 'ID_PROBABILITY', 'ID_RISKS','VALOR'];
 
 
 
 
     public function risksProbabilyCalification()
     {
         return $this->belongsTo('App\risksProbabilityCalification', 'ID_PROBABILITY', 'ID_PROBABILITY');
     }
 
    
 }
 
