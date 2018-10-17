<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_PLANNING
 * @property int $ID_USER
 * @property AuditPlanning $auditPlanning
 */
class AuditAuditorsPlanning extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_AUDITORS_PLANNING';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_PLANNING', 'ID_USER'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditPlanning()
    {
        return $this->belongsTo('App\AuditPlanning', 'ID_PLANNING', 'ID');
    }
}
