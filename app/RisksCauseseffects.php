<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property string $CAUSES
 
 * @property string $CREATEDATE
 * @property Risk $risk
 */
class RisksCauseseffects extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_CAUSESEFFECTS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'ID_FACTOR', 'CREATEDATE'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }

    public function causes()
    {
        return $this->belongsTo('App\RiskFactor', 'ID_FACTOR', 'ID_FACTOR');
    }
}
