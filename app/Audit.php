<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_PROGRAM
 * @property int $PARENT_ID_AUDIT
 * @property string $NAME
 * @property string $OBJECTIVE
 * @property int $ID_USER_MANAGER
 * @property int $ID_USER_RESPONSIBLE
 * @property string $DATE_BEGIN
 * @property string $DATE_END
 * @property string $SCOPE
 * @property string $NAME_PROCESS
 * @property string $CRITERIA
 * @property string $OBSERVATIONS
 * @property string $APPROVED
 * @property string $GLOBAL
 * @property string $NUMERALS
 * @property string $MECI
 * @property string $CLOSED
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 * @property AuditProgram $auditProgram
 */
class Audit extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_PROGRAM', 'PARENT_ID_AUDIT', 'NAME', 'OBJECTIVE', 'ID_USER_MANAGER', 'ID_USER_RESPONSIBLE', 'DATE_BEGIN', 'DATE_END', 'SCOPE', 'NAME_PROCESS', 'CRITERIA', 'OBSERVATIONS', 'APPROVED', 'GLOBAL', 'NUMERALS', 'MECI', 'CLOSED', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditProgram()
    {
        return $this->belongsTo('App\AuditProgram', 'ID_PROGRAM', 'ID');
    }
}
