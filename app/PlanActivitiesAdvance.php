<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_ACTIVITIE
 * @property int $ADVANCE
 * @property string $AUDITOR
 * @property string $OBSERVATION
 */
class PlanActivitiesAdvance extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'PLAN_ACTIVITIES_ADVANCE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_ACTIVITIE', 'ADVANCE', 'AUDITOR', 'OBSERVATION'];

}
