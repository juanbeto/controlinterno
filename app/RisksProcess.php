<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $NAME
 * @property string $OBJECTIVE
 * @property string $CREATEDATE
 * @property int $CREATEDBY
 * @property int $REVISEDBY
 * @property string $APPROVEDBY
 */
class RisksProcess extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'risks_process'; 

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID_PROCCESS';

    /**
     * @var array
     */
    protected $fillable = ['NAME', 'OBJECTIVE', 'CREATEDATE', 'CREATEDBY', 'REVISEDBY', 'APPROVEDBY'];

}
