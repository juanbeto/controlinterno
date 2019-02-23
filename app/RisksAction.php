<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property string $NAME
 * @property string $OWNER
 * @property string $INDICATOR
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
 * @property Risk $risk
 */
class RisksAction extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_ACTION';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'NAME', 'OWNER', 'INDICATOR', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }
}
