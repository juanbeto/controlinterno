<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $CODE
 * @property int $ID_PROCESS
 * @property int $ID_PERIOD
 * @property string $NAME
 * @property string $DESCRIPTION
 * @property string $EFFECTS
 * @property string $CAUSES
 * @property int $CLASSIFICATION
 * @property string $OBJECT
 * @property string $FACTOR
 * @property string $FACTORVULNERABILITY
 * @property string $PROBABILITY
 * @property int $CREATEDBY
 * @property string $CREATEDATE
 * @property RisksAction[] $risksActions
 * @property RisksCauseseffect[] $risksCauseseffects
 * @property RisksControl[] $risksControls
 * @property RisksImpactRisk[] $risksImpactRisks
 * @property RisksPolitic[] $risksPolitics
 * @property RisksScore[] $risksScores
 * @property RisksTablescore[] $risksTablescores
 */
class Risks extends Model
{

    protected $table = 'RISKS';
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['CODE', 'ID_PROCESS','NAME', 'DESCRIPTION', 'ACTIVO', 'AMENAZA', 'TYPE', 'CREATEDBY', 'CREATEDATE'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksActions()
    {
        return $this->hasMany('App\RisksAction', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksCauseseffects()
    {
        return $this->hasMany('App\RisksCauseseffect', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksControls()
    {
        return $this->hasMany('App\RisksControl', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksImpactRisks()
    {
        return $this->hasMany('App\RisksImpactRisk', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksPolitics()
    {
        return $this->hasMany('App\RisksPolitic', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksScores()
    {
        return $this->hasMany('App\RisksScore', 'ID_RISKS', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risksTablescores()
    {
        return $this->hasMany('App\RisksTablescore', 'ID_RISKS', 'ID');
    }
}
