<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $NAME
 */
class RisksControlType extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RISKS_CONTROL_TYPE';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['NAME'];

}
