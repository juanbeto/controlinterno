<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiskUpload extends Model
{
    

    protected $table='RISK_UPLOAD';


    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['TITULO','FECHA_UPLOAD','ARHIVO'];
}
