<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_RISKS
 * @property string $CAUSES
 
 * @property string $CREATEDATE
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property int $CREATED_BY
 * @property int $UPDATED_BY
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
<<<<<<< HEAD
    protected $fillable = ['ID_RISKS', 'ID_FACTOR', 'CREATEDATE'];
=======
    protected $fillable = ['ID_RISKS', 'CAUSES', 'EFFECTS', 'CREATEDATE', 'CREATED_AT', 'UPDATED_AT', 'CREATED_BY', 'UPDATED_BY'];
>>>>>>> e27ae9a45b6fa000681c5cbc7c30ad8ee0790698

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
