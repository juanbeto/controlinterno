<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ID_TABLESCORE
 * @property int $ID_VULNERABILITY
 * @property int $ID_IMPACT
 * @property RisksTablescore $risksTablescore
 * @property RisksVulnerability $risksVulnerability
 * @property RisksImpact $risksImpact
 */
class RisksCoreFact_vul extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_CORE_FACT_VUL';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['ID_TABLESCORE', 'ID_VULNERABILITY', 'ID_IMPACT'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksTablescore()
    {
        return $this->belongsTo('App\RisksTablescore', 'ID_TABLESCORE', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksVulnerability()
    {
        return $this->belongsTo('App\RisksVulnerability', 'ID_VULNERABILITY', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function risksImpact()
    {
        return $this->belongsTo('App\RisksImpact', 'ID_IMPACT', 'ID');
    }
}
