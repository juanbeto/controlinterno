<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $NAME
 * @property int $ID_FACTOR_TYPE
 * @property string $DESCRIPTION
 * @property string $DEFINITION
 * @property RisksFactorType $risksFactorType
 */
class RisksFactor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_FACTOR';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID_FACTOR';

    /**
     * @var array
     */
    protected $fillable = ['NAME', 'ID_FACTOR_TYPE', 'DESCRIPTION', 'DEFINITION'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksFactorType()
    {
        return $this->belongsTo('App\RisksFactorType', 'ID_FACTOR_TYPE', 'ID');
    }
}
