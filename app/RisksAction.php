<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property string $NAME
 * @property string $OWNER
 * @property string $INDICATOR
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
    protected $fillable = ['ID_RISKS', 'NAME', 'OWNER', 'INDICATOR'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }
}
