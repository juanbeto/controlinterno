<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_PROCESS
 * @property int $ID_FUENTE
 * @property int $FUENTE
 * @property string $DEPENDENCE
 * @property string $DATE_FIND
 * @property string $DESCRIPTION
 * @property string $INDICADOR
 * @property string $CUASE
 * @property string $ACTIONS
 * @property string $TYPE_ACTION
 * @property string $DATE_BEGIN
 * @property string $DATE_END
 * @property string $RESPONSABLE_C
 * @property string $RESPONSABLE_B
 * @property string $FORMULATION
 * @property string $CONCEPT
 * @property string $CLOSED
 */
class PlanActivities extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'PLAN_ACTIVITIES';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_PROCESS', 'ID_FUENTE', 'FUENTE', 'DEPENDENCE', 'DATE_FIND', 'DESCRIPTION', 'INDICADOR', 'CUASE', 'ACTIONS', 'TYPE_ACTION', 'DATE_BEGIN', 'DATE_END', 'RESPONSABLE_C', 'RESPONSABLE_B', 'FORMULATION', 'CONCEPT', 'CLOSED'];

}
