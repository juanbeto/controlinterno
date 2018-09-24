<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property int $ID_SCORE
 * @property string $NAME_GROUP
 * @property int $FRECUENCY
 * @property int $IMPACT
 * @property Risk $risk
 * @property RisksScore $risksScore
 */
class RisksTablescore extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_TABLESCORE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'ID_SCORE', 'NAME_GROUP', 'FRECUENCY', 'IMPACT'];

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
    public function risksScore()
    {
        return $this->belongsTo('App\RisksScore', 'ID_SCORE', 'ID');
    }
}
