<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_AUDIT
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
 * @property Audit $audit
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
    protected $fillable = ['ID_AUDIT', 'ID_AREA', 'CYCLE', 'QUESTION', 'NUMERALS', 'RECORDS', 'OBSERVATION', 'ACCORDANCE', 'ACTION', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audit()
    {
        return $this->belongsTo('App\Audit', 'ID_AUDIT', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditAreas()
    {
        return $this->belongsTo('App\AuditAreas', 'ID_AREA', 'ID');
    }
}
