<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_AREA
 * @property string $CYCLE
 * @property string $QUESTION
 * @property string $NUMERALS
 * @property string $RECORDS
 * @property string $OBSERVATION
 * @property string $ACCORDANCE
 * @property string $ACTION
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 * @property AuditArea $auditArea
 */
class AuditPlanning extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_PLANNING';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_AREA', 'CYCLE', 'QUESTION', 'NUMERALS', 'RECORDS', 'OBSERVATION', 'ACCORDANCE', 'ACTION', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditArea()
    {
        return $this->belongsTo('App\AuditArea', 'ID_AREA', 'ID');
    }
}
