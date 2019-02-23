<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $CODE
 * @property int $ID_PROCESS
 * @property int $ID_PERIOD
 * @property string $NAME
 * @property string $DESCRIPTION
 * @property string $EFFECTS
 * @property string $CAUSES
 * @property int $CLASSIFICATION
 * @property string $OBJECT
 * @property string $FACTOR
 * @property string $FACTORVULNERABILITY
 * @property string $PROBABILITY
 * @property int $CREATEDBY
 * @property string $CREATEDATE
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 */
class Risks extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['CODE', 'ID_PROCESS', 'ID_PERIOD', 'NAME', 'DESCRIPTION', 'EFFECTS', 'CAUSES', 'CLASSIFICATION', 'OBJECT', 'FACTOR', 'FACTORVULNERABILITY', 'PROBABILITY', 'CREATEDBY', 'CREATEDATE', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

}
