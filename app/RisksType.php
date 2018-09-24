<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $DESCRIPTION
 * @property boolean $institutional
 */
class RisksType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_TYPE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['DESCRIPTION', 'institutional'];

}
