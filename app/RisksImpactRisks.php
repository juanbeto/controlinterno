<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property int $ID_IMPACT
 * @property string $NAME
 * @property Risk $risk
 * @property RisksImpact $risksImpact
 */
class RisksImpactRisks extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_IMPACT_RISKS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'ID_IMPACT', 'NAME'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksImpact()
    {
        return $this->belongsTo('App\RisksImpact', 'ID_IMPACT', 'ID');
    }
}
