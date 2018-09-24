<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property int $FRECUENCY
 * @property int $IMPACT
 * @property int $SCORE
 * @property string $AREA
 * @property string $AREA_DESC
 * @property string $VALUATION
 * @property string $DESCRIPTION
 * @property Risk $risk
 */
class RisksScore extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_SCORE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'FRECUENCY', 'IMPACT', 'SCORE', 'AREA', 'AREA_DESC', 'VALUATION', 'DESCRIPTION'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }
}
