<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_AUDIT
 * @property string $LOCATION
 * @property string $TYPE_AUDIT
 * @property string $EXECUTION
 * @property string $CONCEPT
 * @property string $OBJECTIVE
 * @property string $ACTIVITIES
 * @property string $NAME_BOSS
 * @property string $CODE
 * @property string $APPROVED
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 */
class AuditInform extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_INFORM';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_AUDIT', 'LOCATION', 'TYPE_AUDIT', 'EXECUTION', 'CONCEPT', 'OBJECTIVE', 'ACTIVITIES', 'NAME_BOSS', 'CODE', 'APPROVED', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

}
