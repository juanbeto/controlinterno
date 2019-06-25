<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $NAME
 * @property string $OBJECTIVE
 * @property string $SCOPE
 */
class PlanProcess extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'PLAN_PROCESS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['NAME', 'OBJECTIVE', 'SCOPE'];

}
