<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $BEGIN
 * @property string $END
 * @property string $OBJECTIVES
 * @property string $SCOPE
 * @property string $RESPOSABILITIES
 * @property string $APPROVED
 * @property string $RESOURCES
 * @property string $OBSERVATION
 * @property string $ENABLE
 * @property string $DELETE
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 */
class AuditProgram extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_PROGRAM';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['BEGIN', 'END', 'OBJECTIVES', 'SCOPE', 'RESPOSABILITIES', 'APPROVED', 'RESOURCES', 'OBSERVATION', 'ENABLE', 'DELETE', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

}
