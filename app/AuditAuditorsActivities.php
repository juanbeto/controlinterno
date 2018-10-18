<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_ACTIVITIE
 * @property int $ID_USER
 * @property AuditActivity $auditActivity
 */
class AuditAuditorsActivities extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_AUDITORS_ACTIVITIES';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_ACTIVITIE', 'ID_USER'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditActivity()
    {
        return $this->belongsTo('App\AuditActivity', 'ID_ACTIVITIE', 'ID');
    }
}
