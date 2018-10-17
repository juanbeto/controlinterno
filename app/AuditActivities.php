<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $BEGIN
 * @property string $END
 * @property string $NAME
 * @property string $NUMERALS_ISO
 * @property string $NUMERALS_MECI
 * @property int $ID_USER_AUDITOR
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 */
class AuditActivities extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'AUDIT_ACTIVITIES';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['BEGIN', 'END', 'NAME', 'NUMERALS_ISO', 'NUMERALS_MECI', 'ID_USER_AUDITOR', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

}
