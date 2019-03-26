<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RisksProbabilityCalification extends Model
{
   //
   protected $table = 'RISK_PROBABILITY_CALIFICATION';
  
   protected $primaryKey = 'ID_PROBABILITY';

   protected $fillable = [ 'ID_USER', 'DATE'];




  
}
