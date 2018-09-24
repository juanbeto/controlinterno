<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property int $ID_CONTROL_TYPE
 * @property string $NAME
 * @property int $DOCUMENT
 * @property int $IS_APPLIED
 * @property int $IS_EFFECTIVE
 * @property RisksControlType $risksControlType
 * @property Risk $risk
 */
class RisksControl extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_CONTROL';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'ID_CONTROL_TYPE', 'NAME', 'DOCUMENT', 'IS_APPLIED', 'IS_EFFECTIVE'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksControlType()
    {
        return $this->belongsTo('App\RisksControlType', 'ID_CONTROL_TYPE', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }
}
