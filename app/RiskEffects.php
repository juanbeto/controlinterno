<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiskEffects extends Model
{
     /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_EFFECTS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID_EFFECTS';

    /**
     * @var array
     */
    protected $fillable = ['NAME'];

   
}
