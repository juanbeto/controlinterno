<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiskEffectsCause extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'risks_effectscause';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_RISKS', 'ID_EFFECTS'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risk()
    {
        return $this->belongsTo('App\Risk', 'ID_RISKS', 'ID');
    }

    public function effects()
    {
        return $this->belongsTo('App\RiskEffects', 'ID_EFFECTS', 'ID_EFFECTS');
    }
}
